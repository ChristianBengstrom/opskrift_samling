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
insert into opskrift( navn, tid, beskrivelse )
  values('Pita', '0:30:00', '1 Tænd ovn. 2 Skær grøntsager. 3 Varm brød. 4 Velbekomme.'),
        ('Cabonara', '0:30:00', '1 Bacon skæres og svitses for jævn varme. De tages op og afdryppes på køkkenrulle. 2 Kog pasta/spagetti. 3 Pisk æg, ost og fløde sammen i en skål og tilsæt bacon. 4  Pasta/spagetti afdryppes i dørslag og hældes i gryden med æggeblandingen. 5 Sæt gryden over for svag varme i 2 min eller til saucen begynder at jævne. Krydres med peber og garneres med krydderurter.');

-- opskrifter
insert into ingrediens( navn, enhed )
  values('Pitabrød', 'stk'),
        ('salat', 'stk'),
        ('majs', 'g'),
        ('pebberfrugt', 'stk'),
        ('løg', 'stk'),
        ('dressing', 'dl'),
        ('kyllingebryst', 'stk'),
        ('kyllingeinderfileter', 'g'),
        ('æg', 'stk'),
        ('parmasanost', 'g'),
        ('pasta', 'g'),
        ('spagetti', 'g'),
        ('bacon', 'g'),
        ('fløde', 'dl'),
        ('salt', 'g'),
        ('pebber', 'g'),
        ('krydderurter', 'bundt');

-- relationer
insert into relation( o_id, i_id, qt )
  values(1, 1, 2),
        (1, 2, 0.1),
        (1, 3, 150),
        (1, 4, 0.2),
        (1, 5, 0.5),
        (1, 6, 1),
        (1, 8, 100),
        (2, 9, 1),
        (2, 10, 25),
        (2, 12, 125),
        (2, 13, 31),
        (2, 14, 0.75),
        (2, 15, 1),
        (2, 16, 1),
        (2, 17, 1);
