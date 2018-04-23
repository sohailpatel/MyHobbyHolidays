create table destinations(tour_id int PRIMARY KEY AUTO_INCREMENT,tour_name varchar(50),tour_country varchar(50),duration int, standard_price int, premium_price int, tag varchar(20), image_link varchar(20), description text);

insert into destinations values(1,"Rome as you like","Italy", 7, 2000, 3500, "Arts", "tour-1.jpg","Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.");
insert into destinations values(1,"Rome as you like","Italy", 7, 2000, 3500, "History", "tour-1.jpg","Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.");
insert into destinations values(1,"Rome as you like","Italy", 7, 2000, 3500, "Nature", "tour-1.jpg","Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.");

insert into destinations values(2,"To Europe, With Love","London", 4, 1000, 2000, "Arts", "tour-2.jpg","Orchestrated by the world's finest Tour Directors and remarkably knowledgeable local guides, our Europe multi-country vacations are designed to allow you to experience and compare a variety of cultures, take in the must-see sights, and make the most vivid memories.");
insert into destinations values(2,"To Europe, With Love","London", 4, 1000, 2000, "Adventure", "tour-2.jpg","Orchestrated by the world's finest Tour Directors and remarkably knowledgeable local guides, our Europe multi-country vacations are designed to allow you to experience and compare a variety of cultures, take in the must-see sights, and make the most vivid memories.");


insert into destinations values(3,"On The Road","Canada", 2, 499, 1299, "Nature", "tour-3.jpg","Canada, one of the largest countries in the world, is home to fun cities like Toronto, Montreal, and Vancouver. Niagara Falls and the Canadian Rockies");
insert into destinations values(3,"On The Road","Canada", 2, 499, 1299, "Architecture", "tour-3.jpg","Canada, one of the largest countries in the world, is home to fun cities like Toronto, Montreal, and Vancouver. Niagara Falls and the Canadian Rockies");

insert into destinations values(4,"Corners of Earth","Australia", 6, 2499, 3299, "Adventure", "tour-4.jpg","On this ancient and spectacular continent, you can dive among the dazzling marine life of the world’s largest coral reef, explore its oldest living rainforests and most sacred rock formations.");
insert into destinations values(4,"Corners of Earth","Australia", 6, 2499, 3299, "Architecture", "tour-4.jpg","On this ancient and spectacular continent, you can dive among the dazzling marine life of the world’s largest coral reef, explore its oldest living rainforests and most sacred rock formations.");
insert into destinations values(4,"Corners of Earth","Australia", 6, 2499, 3299, "Marine", "tour-4.jpg","On this ancient and spectacular continent, you can dive among the dazzling marine life of the world’s largest coral reef, explore its oldest living rainforests and most sacred rock formations.");
insert into destinations values(4,"Corners of Earth","Australia", 6, 2499, 3299, "Sculpture", "tour-4.jpg","On this ancient and spectacular continent, you can dive among the dazzling marine life of the world’s largest coral reef, explore its oldest living rainforests and most sacred rock formations.");

insert into destinations values(5,"Two by the Sea","Paris", 2, 1499, 2100, "Arts", "tour-5.jpg","The city of love captures the hearts of the millions that visit each year and imbues chicness on every street corner. Add to the fact that it's an artist's utopia! Throw in fantastic cuisine, its world-renowned attractions and culture.");

insert into destinations values(6,"Back to the Future","Dubai", 4, 3000, 3600, "Nature", "tour-6.jpg","Dubai is a welcoming neighborhood with many tasty options for cafés and restaurants. The neighborhood has many charming qualities, its rich culture among the more noteworthy.");
insert into destinations values(6,"Back to the Future","Dubai", 4, 3000, 3600, "Adventure", "tour-6.jpg","Dubai is a welcoming neighborhood with many tasty options for cafés and restaurants. The neighborhood has many charming qualities, its rich culture among the more noteworthy.");

create table hotels(hotel_id int, hotel_name varchar(30), standard_price int, image_link varchar(20), description text);

insert into hotels values(1,"Hotel Romania",200,"hotel-1.jpg","A small river named Duden flows by their place and supplies it with the necessary regelialia.");
insert into hotels values(2,"Grand St.Pauls",400,"hotel-2.jpg","Tour the Grand Canal from a gondola or experience a musical tour de force with Baz & get moments to treasure again and again.");
insert into hotels values(3,"Hotel Langham",600,"hotel-3.jpg","Come enjoy our new signature rooms, completely renovated restaurants, pool deck & Race & Sportsbook");
insert into hotels values(4,"Hotel Sqaure Kings",500,"hotel-4.jpg","Stylishly designed with inspired decor and architecture, rooms feature views of the sea, or bustling city.");
insert into hotels values(5,"The Grosveor Hotel",300,"hotel-5.jpg","Located in the heart of city, this apartment building is within walking distance of Saatchi Gallery and Sloane Square.");
insert into hotels values(6,"Park International Hotel",650,"hotel-6.jpg","Park International Hotel offers a bar with wide-screen TV and buffet breakfast (surcharge) each morning.");
insert into hotels values(7,"Georgian Hotel",200,"hotel-7.jpg","Along with a restaurant, this smoke-free guesthouse has a health club and a bar/lounge. WiFi in public areas is free.");
insert into hotels values(8,"The Park Land",700,"hotel-8.jpg","Located in middle of the city, this luxury hotel is within a 10-minute walk of Royal National Theatre, Tate Modern, and Southbank Centre.");


create table tour_bookings(booking_id int PRIMARY KEY AUTO_INCREMENT, tour_id int references destination(tour_id), tour_type int, hotel_id int, booked_by int references user(user_id), group_id int references group(group_id), total_cost decimal, booking_date date, booking_status int);

create table tour_bookings(booking_id int PRIMARY KEY AUTO_INCREMENT, tour_id int, tour_type int, hotel_id int,booked_by varchar(45), group_id int, total_cost decimal, booking_date date, booking_status int);


drop table destinations;