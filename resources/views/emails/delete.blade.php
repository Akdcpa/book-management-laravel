<html>

<head>

    <title>Notification for book deleted</title>

</head>

<body>

   

<center>

<h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">

    <a href="#">Learn more...{{$email}}</a>

</h2>

</center>

  

<p>Hi {{$name}},</p>

<p>
hey you have deleted a new stack of book in our website book-management-systems.
The Book Details will below:
    <li>  Book Name : {{$book_name}}</li>
    <li>Author:{{$author}}</li>
    <li>price:{{$price}}</li>
    <li>description:{{$description}}</li>

</p>

  

<strong>Thank you. :)</strong>

  

</body>

</html>