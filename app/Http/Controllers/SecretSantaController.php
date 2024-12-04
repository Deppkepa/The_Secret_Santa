<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\count;

class SecretSantaController extends Controller
{
    public function index()
    {
        return view('secret-santa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string|max:255'
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('description');
        $data = [
            'number' => null,
            'name' => $name,
            'email' => $email,
            'description' => $description,
            'number_recipient' => "null"

        ];
        $filePath = storage_path('app/users.json'); 
        $count = 0;
        if (file_exists($filePath)) {
            $jsonData = json_decode(file_get_contents($filePath), true);
            $count = count($jsonData);
            $data['number'] = $count + 1;
            $jsonData[] = $data;
        } else {
            $jsonData = [$data];
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return redirect()->route('secret-santa.index')->with('success', 'Вы успешно зарегистрировались для Тайного Санты!');
    }
    public function table()
       {
           $filePath = storage_path('app/users.json');
           if (file_exists($filePath)) {
               $users = json_decode(file_get_contents($filePath));
           } else {
            return "ошибка чтения файла";    
        }
           return view('table', compact('users'));
       }
}
