DROP DATABASE IF EXISTS opskrift_samling;

CREATE DATABASE opskrift_samling;
USE opskrift_samling;

-- CREATING TABLES -------------------------------------------------

-- opskrifter--
create table opskrift(
  id int auto_increment primary key,
  navn varchar(32) not null,
  tid time not null,
  beskrivelse text not null
);

-- ingredienser
create table ingrediens(
  id int auto_increment primary key,
  navn varchar(32) not null,
  enhed enum('tsk','spsk','dl','cl', 'l', 'ml', 'hl', 'mg', 'g','kg', 'stk', 'bundt') not null
);

-- relationstabel
create table relation(
  o_id int not null,
  i_id int not null,
  qt decimal(6,2) not null,

  primary key (o_id, i_id),
  foreign key(o_id) references opskrift(id),
  foreign key(i_id) references ingrediens(id)
);


-- CREATE TABLE `users` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email_verified_at` timestamp NULL DEFAULT NULL,
--   `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   `role` enum('T', 'S') not null DEFAULT 'S'
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `users_email_unique` (`email`);
--
-- ALTER TABLE `users`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


-- SEEDING TABLES -------------------------------------------------

-- INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
-- (1, 'Christian', 'christianbengstroem@hotmail.com', NULL, '$2y$10$s/OBdn7EdnyxVkTi4/vTK.DkoHDr4J9l/aRcyGv3zGTphizsn776C', 'QUQNfvVHNhdGYm16gjaNLrans3MH8n8Lw9RM8uaZgTZ2HUE0KX34ZAGSSesK', '2019-02-07 09:34:42', '2019-02-07 09:34:42','T'),
-- (2, 'test', 'test@hotmail.com', NULL, '$2y$10$MhaZbWQGTcKXoejKq3CmnujFYtmONfChQwV4PVgJbRxVsaF6HemzO', 'nRqfkJyFunvmM9x0BbCofUmsj9N7yPd5Wt0N2pMkk6MhrTIMbmt5XnX3ITj8', '2019-02-07 09:34:52', '2019-02-07 09:34:52','S');

-- opskrifter
INSERT INTO `opskrift` (`id`, `navn`, `tid`, `beskrivelse`) VALUES
(1, 'Pita', '00:30:00', '1 Tænd ovn. 2 Skær grøntsager. 3 Varm brød. 4 Velbekomme.'),
(2, 'Cabonara', '00:30:00', '1 Bacon skæres og svitses for jævn varme. De tages op og afdryppes på køkkenrulle. 2 Kog pasta/spagetti. 3 Pisk æg, ost og fløde sammen i en skål og tilsæt bacon. 4  Pasta/spagetti afdryppes i dørslag og hældes i gryden med æggeblandingen. 5 Sæt gryden over for svag varme i 2 min eller til saucen begynder at jævne. Krydres med peber og garneres med krydderurter.'),
(3, 'Ravioli med gorgonzola sauce', '02:00:00', '1 Ravioli pasta - \r\nMel og salt sigtes ned i en skål. Lav en fordybning i midten af melet og kom æg og olivenolie deri.  Med en gaffel røres rundt i æggene, som langsomt tager mere og mere mel ind, til det bliver en smidig dej som æltes godt til den er helt glat og smidig. Sættes på køl i minimum en time eller til dagen efter.\r\n\r\n2 Når raviolien skal samles, så rulles dejen tyndt ud på et meldrysset bord, med en kagerulle eller pastarulle. Stik ud med glas i runde cirkler.\r\n\r\n3 Fyld til ravioli - \r\nSvampene udblødes i vand efter anvisning på pakken, vandet hældes fra og de duppes tørre.\r\n\r\n4 Hak svampe og persille fint og bland med presset hvidløg. Rør sammen med ricotta og en lille smule salt.\r\n\r\n5 Fyld raviolierne - \r\nPå hver cirkel pasta kommer du en lille klat fyld. Ikke ret meget, for de skal kunne lukkes godt.\r\n\r\n6 Foldes på midten, tryk dem sammen langs kanten og derefter trykkes med en gaffel et fint mønster – det gør også lige det sidste, for at de lukkes ordentligt.\r\n\r\n7 Koges i 3,5 minut i en stor gryde med kogende vand tilsat en spiseskefuld olivenolie og et drys salt.\r\n\r\n8 Gorgonzola sauce - \r\nSteg bacon sprød på panden (undlad hvis vegetar), tilsæt løg som du steges gyldne og bløde. Kom fløden og gorgonzolaen i en gryde og varm op for medium varme – det skal ikke koge. Lige før det koger skrues lidt ned for varmen. Tilsæt den stegte bacon bacon og løg, kog op og server til ravioli med et drys krydderurter.\r\n\r\n9 Bemærk - \r\nOpskriften rækker til dobbelt antal personer ved forret');

-- opskrifter
INSERT INTO `ingrediens` (`id`, `navn`, `enhed`) VALUES
(1, 'Pitabrød', 'stk'),
(2, 'salat', 'stk'),
(3, 'majs', 'g'),
(4, 'pebberfrugt', 'stk'),
(5, 'løg', 'stk'),
(6, 'dressing', 'dl'),
(7, 'kyllingebryst', 'stk'),
(8, 'kyllingeinderfileter', 'g'),
(9, 'æg', 'stk'),
(10, 'parmasanost', 'g'),
(11, 'pasta', 'g'),
(12, 'spagetti', 'g'),
(13, 'bacon', 'g'),
(14, 'fløde', 'dl'),
(15, 'salt', 'g'),
(16, 'pebber', 'g'),
(17, 'krydderurter', 'bundt'),
(18, 'durummel', 'g'),
(19, 'olivenolie', 'spsk'),
(20, 'tørrede svampe', 'g'),
(21, 'ricotta', 'g'),
(22, 'bredbladet persille', 'bundt'),
(23, 'hvidløg', 'stk'),
(24, 'gorgonzola', 'g');

-- relationer
INSERT INTO `relation` (`o_id`, `i_id`, `qt`) VALUES
(1, 1, '2.00'),
(1, 2, '0.10'),
(1, 3, '150.00'),
(1, 4, '0.20'),
(1, 5, '0.50'),
(1, 6, '1.00'),
(1, 8, '100.00'),
(2, 9, '1.00'),
(2, 10, '25.00'),
(2, 12, '125.00'),
(2, 13, '31.00'),
(2, 14, '0.75'),
(2, 15, '1.00'),
(2, 16, '1.00'),
(2, 17, '1.00'),
(3, 5, '0.12'),
(3, 9, '1.00'),
(3, 13, '20.00'),
(3, 14, '0.50'),
(3, 15, '1.00'),
(3, 18, '100.00'),
(3, 19, '0.25'),
(3, 20, '10.00'),
(3, 21, '65.00'),
(3, 22, '0.25'),
(3, 23, '0.25'),
(3, 24, '45.00');
