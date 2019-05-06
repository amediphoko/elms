<p>Hi, {{$user->first_name}}</p><br>
<p> Your account has been successfully created, </p>
<p> To verify account creation please <a href="{{route('sendEmailDone', ['email' => $user->email, 'verifyToken' => $user->verifyToken])}}">click here</a></p>
<br>
<p>Ignore if you have not used this email to create account.</p>