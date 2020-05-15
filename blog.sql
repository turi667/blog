-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 03:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(37, 'Porsche'),
(38, 'Audi'),
(40, 'Mercedes Benz'),
(41, 'Bmw');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(68, 170, 'arturtola', '', 'Very Nice', 'approved', '2020-05-08'),
(69, 169, 'arturtola', '', 'Nice', 'approved', '2020-05-08'),
(70, 169, 'albanhoxha', '', 'Big Like', 'approved', '2020-05-08'),
(71, 172, 'albanhoxha', '', 'Nice One', 'approved', '2020-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(169, 40, '2020 Mercedes-AMG S63 Sedan Review: An AMG With Class', 'admin', '2020-05-08', '3e55f038880182463972beb6ecfa4f35.png', '<p>Within every family, thereat least one rebellious child or cousin. The person with a little glint of madness in their eyes, the risk-taker, the one whose more conservative siblings look down upon them with disdain (or is that jealousy?). The AMG S63 neatly fits that description within the S-Class family. While every other model in the range is obsessed with following all the rules in the luxury sedan playbook and cocooning the driver and passengers in one of the most luxurious, quietest cabins in the world, the S63 wants to have a bit more fun than that. Under the hood is a handcrafted 4.0-liter bi-turbo V8 with 603 horsepower, hurtling this cruise ship down the road to 60 mph in just 3.5 seconds - no other S-Class is faster. The AMG 4Matic+ all-wheel-drive system does a remarkable job of transferring all that grunt to the road and endows the S63 with more agility than other models in the range. And yet, the V8 fury and the AMG styling touches have done nothing to erode those typical S-Class qualities of insulation and a sublime ride, along with every available comfort and safety feature there is. The mischievous kids always stay out a bit later, and the S63 is the S-Class thatll ensure you always take the long way home.</p><p><br>&nbsp;</p>', 'Mercedes 63 AMG', 2, 'draft', 9),
(170, 38, 'Audi A8 L', 'albanhoxha', '2020-05-08', 'c831196b371863ae161bceac1262638c.png', '<p>A big, important barge of a thing relatively few will buy, and a technical achievement few have the resources or engineering might to match or surpass. It’s the new Audi A8 – the cleverest Audi of all. And so it should be, because if you really want to see what a manufacturer is truly capable of engineering, you look at its flagship. And the A8 is and always had been Audi’s, which is why the new one gets a load of tech’ we haven’t seen before, but almost certainly will on future A6s and&nbsp;A4s.</p>', 'audi a8 fs', 1, 'published', 5),
(171, 40, '2020 Mercedes-AMG S63 Sedan Review: An AMG With Class', 'admin', '2020-05-08', 'e5382d4b4a4fee28def3744337ddf6b6.png', '<h2>By subtly refining the sixth-generation S-Class design through the years, Mercedes-Benz has managed to keep the shape modern and appealing, even deep into its life cycle. No element of the exterior appears overdone - is all restrained, classy, and timeless. The S63 is the boldest in the range, though, with its 20-inch AMG alloy wheels, AMG body styling (larger mesh air intakes and gloss black trim), and four trapezoidal exhaust tips at the back. All-LED exterior lighting is used and a powered panorama roof provides sky views for both front and rear passengers.</h2>', 'Mercedes 63 AMG', 0, 'draft', 1),
(172, 37, 'Porsche 911 Carrera', 'arturtola', '2020-05-08', '90b16df652c1230c125a707472cc242c.png', '<p>Here what got us: Stepping up from a 911 Carrera S to the all-wheel-drive Carrera 4S costs $7300. That extra outlay buys you all-wheel drive and, well, that it. There is no standard-equipment difference between the S and the 4S beyond the all-wheel-drive hardware and a gas tank that holds an extra 0.7 gallon. Elsewhere in the auto industry, both mainstream and luxury brands usually charge between $1000 and $2500 to upgrade from a two-wheel-drive vehicle to the all-wheel-drive model.</p>', 'Porsche 911 2020', 1, 'published', 4),
(173, 40, 'Mercedes Benz S 63', 'admin', '2020-05-08', '509d727ef6ad45e84c3b5ad5d2414c73.png', '<p>You can get your AMG S63 in a choice of 13 colors. The only non-metallic shade is black, while the metallics consist of Magnetite Black, Diamond Silver, Emerald Green, Obsidian Black, Selenite Grey, Dune Silver, Anthracite Blue, Iridium Silver, Lunar Blue, and Ruby Black. Two shades will cost you extra: designo Diamond White metallic at $795 and designo Cashmere White in a matte finish for a whopping $3,950. The Cashmere White does look fantastic, though, but so does an S63 in plain black.</p>', '63 2020 benz', 0, 'draft', 2),
(174, 41, 'Bmw', 'admin', '2020-05-08', 'a84a7f663869af13daff53fdfa55716c.png', '<p>You can get your AMG S63 in a choice of 13 colors. The only non-metallic shade is black, while the metallics consist of Magnetite Black, Diamond Silver, Emerald Green, Obsidian Black, Selenite Grey, Dune Silver, Anthracite Blue, Iridium Silver, Lunar Blue, and Ruby Black. Two shades will cost you extra: designo Diamond White metallic at $795 and designo Cashmere White in a matte finish for a whopping $3,950. The Cashmere White does look fantastic, though, but so does an S63 in plain black.</p>', 'Bmw', 0, 'published', 0),
(175, 40, 'Brabus', 'arturtola', '2020-05-08', '4007bf1aa4d7afba06723a417745f2a8.png', '<p>2020 Mercedes-AMG S63 Sedan Review: An AMG With Class</p><p>The AMG&nbsp;</p><p>S63</p><p>&nbsp;neatly fits that description within the S-Class family. ... Under the hood is a handcrafted 4.0-liter bi-turbo V8 with 603 horsepower, hurtling this cruise ship down the road to 60 mph in just 3.5 seconds - no other S-Class is faster.</p>', '700 brabus', 0, 'published', 0),
(176, 38, 'Audi rs6', 'arturtola', '2020-05-08', '32f1b190f09e064faab4a43059e5b667.png', '<p><strong>2020 Audi RS6 Avant Was Worth the Wait. ... For the first time, the 2020 Audi RS6 Avant will be available in the United States, and it arriving ready to scrap. HIGHS: Everything you could want or need in just one car, looks like no wagon before it, close to 600 horsepower</strong></p>', 'Rs6 Audi', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `confirmtoken` text NOT NULL,
  `joined` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`, `activated`, `confirmtoken`, `joined`) VALUES
(199, 'arturtola', '$2y$12$FjjdoaFR7yTsCHKj.tavIu7bX2iGWzmSkwm57/.P6lhiMqPF6mmyW', 'artur', 'tola', 'arturtola@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '', 1, '', '2020-05-07'),
(200, 'admin', '$2y$12$KIaegU5lxGp0wyDVUt9I4emp6G7RzXyiqY20kWEvzAwz3vi2QCuCm', 'admin', 'admin', 'admin@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', '', 1, '', '2020-05-07'),
(201, 'albanhoxha', '$2y$12$XIn7gW9OOk6rBtQXd65uwOC.tPcnMHkrkDqlHRndUzvKm2gku57bq', 'alban', 'hoxha', 'alban@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '', 1, '', '2020-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(13, 'k4rpglkma2q8bh5alt1b0lnp1d', 1588922829),
(14, '4ah48r0tv6q8itrujgv9er4sev', 1588958612),
(15, 'mc1k3oa24ale3vupvh8elagog1', 1588959484),
(16, 's6gvaspl3f480gpikiuolid6vf', 1588988393);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
