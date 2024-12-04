<!DOCTYPE html>
   <html lang="ru">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Пользователи</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
   </head>
   <body>
   @include('header')
       <div class="container" style="overflow-y: scroll; height: 550px;">
           <h1>Пользователи</h1>
           <table class="table table-bordered">
               <thead>
                   <tr>
                        <th>number</th>
                       <th>Имя пользователя</th>
                       <th>Email</th>
                       <th>Сообщение</th>
                       <th>Кому даришь</th>
                   </tr>
               </thead>
               <tbody>
               <?php 
                    $memory_num = []; 
                    $usedNumbers = [];
                    $hasNullRecipient = false;
                    foreach ($users as $user) {
                        if ($user->number_recipient == "null") {
                            foreach ($users as $item) {
                                $item->number_recipient = "null";
                            }
                            break;
                        }
                    }       
               ?>
                    @foreach($users as $user)
                       <tr>
                       <?php
                            if ($user->number_recipient == "null") {
                                do {
                                    $number = rand(1, count($users));
                                } while (in_array($number, $usedNumbers) || $number == $user->number);
                                $usedNumbers[] = $number;
                                $user->number_recipient = $number;
                                $memory_num[] = [$user->number, $user->number_recipient];
                            }
                        ?> 
                           <td>{{ $user -> number }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->description }}</td>
                           <td>{{ $user->number_recipient }}</td>
                       </tr>
                   @endforeach
                   <?php 
                        $usedNumbers = [];
                        $filePath = storage_path('app/users.json');
                        if (file_exists($filePath)) {
                            $data = json_decode(file_get_contents($filePath));
                            foreach ($data as $item){
                                foreach ($memory_num as $one) { 
                                    if ($item -> number == $one[0]) { 
                                        $item -> number_recipient = $one[1];
                                        break; 
                                    } 
                                }
                            }
                        }
                        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
                        $memory_num = [];
                    ?>  
               </tbody>
           </table>
       </div>
       @include('footer') 
   </body>
   </html>
   