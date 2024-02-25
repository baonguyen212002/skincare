<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'options.mail_host' => 'required|string',
            'options.mail_port' => 'required|numeric',
            'options.mail_encryption' => 'required|in:tls,ssl',
            'options.mail_username' => 'required|string',
            'options.mail_password' => 'required|string',
        ]);

        // Create the Setting model
        $setting = new Setting();
        $setting->options = [
            'mail_host' => $validatedData['options']['mail_host'],
            'mail_port' => $validatedData['options']['mail_port'],
            'mail_encryption' => $validatedData['options']['mail_encryption'],
            'mail_username' => $validatedData['options']['mail_username'],
            'mail_password' => $validatedData['options']['mail_password'],
        ];
        $setting->save();

        // Update the .env file
        $this->updateEnvFile($setting);

        // Redirect with success message
        return redirect()->route('setting.index')->with('success', 'Cài đặt đã được lưu thành công.');
    }

    public function update(Request $request, Setting $setting)
    {
        // Lấy dữ liệu từ form
        $data = $request->all();

        // Cập nhật dữ liệu trong cơ sở dữ liệu
        $setting->update($data);

        // Gọi hàm để cập nhật tệp .env
        $this->updateEnvFile($setting);

        return redirect()->route('setting.index')->with('success', 'Cài đặt đã được cập nhật thành công.');
    }

    public function updateEnvFile(Setting $setting)
    {
        if ($setting && isset($setting->options) && is_array($setting->options)) {
            $envFile = base_path('.env');

            $envContent = file_get_contents($envFile);

            $envContent = preg_replace("/MAIL_HOST=(.*)/", "MAIL_HOST=" . $setting->options['mail_host'], $envContent);
            $envContent = preg_replace("/MAIL_PORT=(.*)/", "MAIL_PORT=" . $setting->options['mail_port'], $envContent);
            $envContent = preg_replace("/MAIL_USERNAME=(.*)/", "MAIL_USERNAME=" . $setting->options['mail_username'], $envContent);
            $envContent = preg_replace("/MAIL_PASSWORD=(.*)/", "MAIL_PASSWORD=" . $setting->options['mail_password'], $envContent);
            $envContent = preg_replace("/MAIL_ENCRYPTION=(.*)/", "MAIL_ENCRYPTION=" . $setting->options['mail_encryption'], $envContent);

            $mailFromAddress = $setting->options['mail_username'] ?: DB::table('settings')->value('mail_username');
            $envContent = preg_replace("/MAIL_FROM_ADDRESS=(.*)/", "MAIL_FROM_ADDRESS='" . $mailFromAddress . "'", $envContent);

            // Update the .env file
            file_put_contents($envFile, $envContent);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
