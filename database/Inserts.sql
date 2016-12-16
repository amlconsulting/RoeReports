INSERT INTO amlcon5_roereports.users (first_name, last_name, email, notification_email, password, verified, activation_token, remember_token, created_at, updated_at, stripe_id, card_brand, card_last_four, trial_ends_at) VALUES 
('Alex', 'Lane', 'amlane86@yahoo.com', 'amlane86@yahoo.com', '$2y$10$x4uewiGprBDd3XAhBtXe7enEqmqklsCmRbwqqwITo1.vaWtdA4P9O', 1, null, 'NrTQkt7doDsQbpaCz5pX0bl4z3b9abD1LrXzLaBhMwDpw0hDPnv7DlZLXKdU', '2016-12-09 13:24:55', '2016-12-09 20:19:36', 'cus_9iJhszhcvkGYpR', 'MasterCard', '4444', null),
('test', 'test', 'test@example.com', 'test@example.com', '$2y$10$rz4g4.KhQJIOYYPdDIzZrOpxNAkij2.Yw.K3KsBJOWSfWHiLM6WZe', 1, null, 'lK9lSqCvFT6mdZ2bjfgabiKW867i080Usx5IeqyvjNnS0zfnvCguysmGDnMW', '2016-12-09 13:31:14', '2016-12-09 14:40:56', 'cus_9iJnJVEnDoSCsi', 'Visa', '4242', null),
('Test2', 'User', 'test2@example.com', 'test2@example.com', '$2y$10$wcXT9rrizSaEBSfUPRAmKuUD32RqM1BNw8yueOtaq5Wp4P2eoSfHm', 1, null, 'YseE7BvyMZCYwM3JAyT3Pe1hLXnSvV5Ub2ypc3O94iuMV1ZVg8Jn4B12CTW2', '2016-12-09 14:40:46', '2016-12-09 18:43:49', 'cus_9iKwGFpxKMgDkf', 'MasterCard', '4444', null),
('Lyndsie', 'Lane', 'lainy@lainylane.com', 'lainy@lainylane.com', '$2y$10$fzVEE3SeFK3/FUllkl5nE.HdZ4BH31XcTEA11onruif2Gw5tQ2.ci', 1, null, 'qw2JrzlaqVMamI4BNDfwXv9iQlbLjhxXrcxj1HNutIEvQfTbM0VjHH7lgf1O', '2016-12-09 18:44:48', '2016-12-14 14:11:14', 'cus_9iOs0KNqVOiEDZ', 'Visa', '4242', null),
('Holli', 'Thompson', 'hollithompson@yahoo.com', 'hollithompson@yahoo.com', '$2y$10$7iIvDQmX/Iq6wx/y6KbsKeK000bcp37AEFRcY6F.gofotTHf.Csa.', 1, null, 'ISRQTokiVurkynRf27rHZRzU1fNjVZRvvCLeKryOqIiPeEvbCHDT93hD5i37', '2016-12-09 19:21:13', '2016-12-09 19:35:30', 'cus_9iPR7WrCHEwy2k', 'Visa', '4242', null),
('Test', 'User3', 'test3@example.com', 'test3@example.com', '$2y$10$UXToGaD3bdULyctC0Myya.5kOuZnSSXZws7sWgwDLV72ZMUc6Bmvy', 1, null, null, '2016-12-09 20:54:29', '2016-12-09 20:58:37', 'cus_9iQzzWVbWjtYkx', 'MasterCard', '4444', null),
('Test', 'User4', 'test4@example.com', 'test4@example.com', '$2y$10$7QuXxuM/at2Lfe1d8XWT0.woB.opA6updXuZwRBci11W2HcMs5idq', 1, null, null, '2016-12-10 12:56:48', '2016-12-10 12:59:48', 'cus_9igTAOuMbg2uuy', 'Visa', '4242', null),
('Bob', 'Bob', 'bob@test.com', 'bob@test.com', '$2y$10$/eExpBjbtLiX2f/KrLoNN.BqQKARjoj0NTue.nHk5gEyRWdL.HgPS', 1, null, '08mpKnHsSr4olduaqhk8jXO91tqGWTZ3pC8n8YWHRPOevQvr2OlgPlRPFWe8', '2016-12-14 12:48:11', '2016-12-14 12:52:35', null, null, null, null);

INSERT INTO amlcon5_roereports.social_accounts (user_id, provider_user_id, provider, created_at, updated_at) VALUES 
(2, '10154273036363551', 'facebook', '2016-12-09 14:53:16', '2016-12-09 14:53:16');

INSERT INTO amlcon5_roereports.subscriptions (user_id, name, stripe_id, stripe_plan, quantity, trial_ends_at, ends_at, created_at, updated_at) VALUES(2, 'main', 'sub_9iJhbjmb5kCZjL', 'pro', 1, '2016-12-16 13:25:49', null, '2016-12-09 13:25:49', '2016-12-09 13:29:25'),
(3, 'main', 'sub_9iKb4J2hod8N9l', 'pro-yearly', 1, '2016-12-16 14:21:44', '2016-12-16 14:21:44', '2016-12-09 14:21:44', '2016-12-09 14:38:57'),
(4, 'main', 'sub_9iKwovDaDjxsmB', 'pro', 1, '2016-12-16 14:42:33', null, '2016-12-09 14:42:33', '2016-12-09 14:42:33'),
(5, 'main', 'sub_9iOsUpXOtfjlyH', 'basic', 1, '2016-12-16 18:47:06', null, '2016-12-09 18:47:06', '2016-12-09 18:49:15'),
(6, 'main', 'sub_9iPSfhQi7swlBU', 'pro', 1, '2016-12-16 19:22:29', null, '2016-12-09 19:22:29', '2016-12-09 19:22:29'),
(7, 'main', 'sub_9iQzFgA9vCE14u', 'basic', 1, '2016-12-16 20:57:35', null, '2016-12-09 20:57:35', '2016-12-09 20:57:55'),
(8, 'main', 'sub_9igTF10SPMVBYj', 'pro-yearly', 1, '2016-12-17 12:58:15', null, '2016-12-10 12:58:15', '2016-12-10 13:16:34');


INSERT INTO amlcon5_roereports.size (description, created_at, updated_at) VALUES 
('XXXS', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('XXS', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('XS', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('S', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('M', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('L', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('XL', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('XXL', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('XXXL', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('Tween', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('OS', '2016-12-15 14:23:41', '2016-12-15 14:23:41'),
('TC', '2016-12-15 14:23:41', '2016-12-15 14:23:41');

INSERT INTO amlcon5_roereports.item (description, created_at, updated_at) VALUES 
('Carly', '2016-12-15 14:25:51', '2016-12-15 14:25:51'),
('Randy', '2016-12-15 14:25:51', '2016-12-15 14:25:51'),
('Leggings', '2016-12-15 14:25:51', '2016-12-15 14:25:51'),
('Julia', '2016-12-15 14:25:51', '2016-12-15 14:25:51'),
('Cassie', '2016-12-15 14:25:51', '2016-12-15 14:25:51'),
('Lindsey', '2016-12-15 14:25:51', '2016-12-15 14:25:51');

INSERT INTO amlcon5_roereports.clients (name, email, address, city, state, zipcode, created_at, updated_at) VALUES 
('Alex Lane', 'amlane86@yahoo.com', '1241 Little Deer Run', 'Canton', 'GA', '30114', '2016-12-15 16:07:37', '2016-12-15 16:07:37');

INSERT INTO amlcon5_roereports.clients (name, email, address, city, state, zipcode, created_at, updated_at) VALUES
('Alex Lane', 'amlane86@yahoo.com', '1241 Little Deer Run', 'Canton', 'GA', '30114', '2016-12-15 16:07:37', '2016-12-15 16:07:37'),
('Lyndsie Lane', 'lainy@lainy.com', '1241 Little Deer Run', 'Canton', 'GA', '30114', '2016-12-15 16:12:01', '2016-12-15 16:12:01');

INSERT INTO amlcon5_roereports.invoiceHeader (user_id, client_id, invoiceNum, shipped, invoiceDate, total, discount, tax, subTotal, totalPaid, created_at, updated_at) VALUES
(5, 1, 53259869, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259222, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259333, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259444, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259555, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259543, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(5, 1, 53259345, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 13:35:41', '2016-12-15 13:35:41'),
(2, 1, 65554444, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554476, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554487, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554466, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554462, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554463, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554443, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33'),
(2, 1, 65554433, 0, '2016-12-15 12:30:00', 35, 0, 2, 37, 37, '2016-12-15 14:04:33', '2016-12-15 14:04:33');

INSERT INTO amlcon5_roereports.invoiceDetail (invoiceHeader_id, item_id, quantity, price, created_at, updated_at, size_id) VALUES 
(1, 1, 1, 35, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 3),
(2, 2, 1, 35, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 4),
(2, 4, 2, 45, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 2),
(3, 3, 2, 25, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 10),
(3, 3, 1, 25, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 12),
(3, 6, 1, 40, '2016-12-15 14:31:36', '2016-12-15 14:31:36', 7);