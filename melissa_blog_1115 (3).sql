-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2016 at 02:51 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `melissa_blog_1115`
--
CREATE DATABASE IF NOT EXISTS `melissa_blog_1115` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `melissa_blog_1115`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`category_id` smallint(4) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'News'),
(2, 'Entertainment'),
(3, 'Sports'),
(4, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `post_id` smallint(6) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `body`, `date`, `is_approved`) VALUES
(1, 2, 1, 'Etiam viverra, sapien et pharetra ullamcorper, libero nisi tempor magna, eget ornare lectus dui et magna. Curabitur mi risus, pretium elementum fringilla ut, venenatis eget dui. Phasellus quis semper neque, eu mollis dui. Sed sit amet elit vitae velit convallis eleifend tempor nec massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget dictum magna, eget semper arcu. Fusce pharetra quam dolor, vel dignissim nisl elementum eget. Morbi arcu magna, maximus at eleifend ac, congue eu tellus. Ut molestie ullamcorper feugiat. Maecenas mollis quis ante sed lacinia. Morbi vulputate pretium velit, et viverra magna pulvinar non. Aeneat libero, ut mattis lorem elementum in.', '2015-11-10 09:51:53', 1),
(2, 1, 2, 'First!!1', '2015-11-10 09:52:09', 0),
(3, 1, 1, 'Happy Monday!~', '2015-11-16 08:53:38', 1),
(4, 1, 1, 'This should work...', '2015-11-16 08:55:24', 1),
(6, 1, 1, 'another\r\n', '2015-11-16 08:59:18', 1),
(7, 1, 2, 'beanssss', '2015-11-16 09:00:06', 1),
(8, 1, 3, 'one problem...', '2015-11-16 09:00:20', 1),
(9, 1, 3, 'yay', '2015-11-16 09:11:25', 1),
(10, 1, 1, 'tessssssttt', '2015-11-16 09:18:23', 1),
(11, 1, 1, 'Etiam viverra, sapien et pharetra ullamcorper, libero nisi tempor magna, eget ornare lectus dui et magna. Curabitur mi risus, pretium elementum fringilla ut, venenatis eget dui. Phasellus quis semper neque, eu mollis dui. Sed sit amet elit vitae velit convallis eleifend tempor nec massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget dictum magna, eget semper arcu. Fusce pharetra quam dolor, vel dignissim nisl elementum eget. Morbi arcu magna, maximus at eleifend ac, congue eu tellus. Ut molestie ullamcorper feugiat. Maecenas mollis quis ante sed lacinia. Morbi vulputate pretium velit, et viverra magna pulvinar non. Aenean venenatis tincidunt nisl, vitae ornare leo iaculis et. Praesent vestibulum consequat libero, ut mattis lorem elementum in.', '2015-11-16 09:18:48', 1),
(12, 1, 3, 'dafgdas', '2015-11-16 09:23:13', 1),
(13, 1, 1, 'gfhcxdjgdehj', '2015-11-16 11:23:51', 1),
(14, 1, 3, 'test of feedback', '2015-11-16 21:30:19', 1),
(15, 1, 3, 'test sadfgkljushbad,.jhasdff', '2015-11-16 21:30:36', 1),
(16, 1, 3, 'adsfgsdfgdsty', '2015-11-16 21:30:41', 1),
(17, 3, 5, 'It&#39;s me, blobby and I can comment!', '2015-11-25 18:44:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
`link_id` mediumint(9) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `user_id` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `title`, `description`, `url`, `user_id`) VALUES
(1, 'codepen', 'So amazing', 'http://codepen.io', 1),
(2, 'amazon', 'Buy everything here', 'http://amazon.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
`post_id` smallint(6) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `body` text NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `category_id`, `date`, `body`, `user_id`, `is_public`, `allow_comments`) VALUES
(1, 'Coffee is the best thing ever!!!', 1, '2015-11-10 09:49:19', '<p>Donut cupcake candy sesame snaps cheesecake ice cream. Topping wafer bonbon biscuit dessert chupa chups cookie sweet dessert. Sweet roll tootsie roll jelly-o cookie sugar plum caramels ice cream brownie gingerbread. Marshmallow macaroon icing gummi bears halvah tiramisu. Apple pie cake croissant dessert biscuit apple pie cookie carrot cake fruitcake. Sweet dragée sweet roll tiramisu pastry muffin fruitcake halvah. Cake dragée sesame snaps oat cake caramels chocolate bar. Topping chocolate bonbon tiramisu dessert marzipan. Bear claw tootsie roll jujubes powder ice cream tart. Chocolate cake marzipan sweet jelly tart jelly beans. Marshmallow muffin cheesecake lemon drops icing fruitcake croissant caramels. Cookie gummies marshmallow. Sweet cake chocolate bar tiramisu pudding tart pudding chocolate cake ice cream. Jujubes jelly-o lollipop lemon drops caramels sugar plum.incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>  <p>When, while the lovely valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my trees, and but a few stray gleams steal into the inner sanctuary, I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath of that universal love which bears and sustains us, as it floats around us in an eternity of bliss; and then, my friend, when darkness overspreads my eyes, and heaven and earth seem to dwell in my soul and absorb its power, like the form of a beloved mistress, then I often think with longing, Oh, would I could describe these conceptions, could impress upon paper all that is living so full and warm within me, that it might be the mirror of my soul, as my soul is the mirror of the infinite God!</p>  <p>O my friend -- but it is too much for my strength -- I sink under the weight of the splendour of these visions! A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>  <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and</p>', 2, 1, 1),
(2, 'Dried edamame Beans', 1, '2015-11-10 09:50:07', '<p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim.</p>  <p>Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex. Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack! " my brave ghost pled. Five quacking zephyrs jolt my wax bed. Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. Few quips galvanized the mock jury box.</p>  <p>Quick brown dogs jump over the lazy fox. The jay, pig, fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was gazed by MTV for luck. A wizard''s job is to vex chumps quickly in fog. Watch "Jeopardy! ", Alex Trebek''s fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him.</p>  <p>Adjusting quiver and bow, Zompyc[1] killed the fox. My faxed joke won a pager in the cable TV quiz show. Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit. Six big devils from Japan quickly forgot how to waltz. Big July earthquakes confound zany experimental vow. Foxy parsons quiz and cajole the lovably dim wiki-girl. Have a pick: twenty six letters - no forcing a jumbled quiz!</p>  <p>Crazy Fredericka bought many very exquisite opal jewels. Sixty zippers were quickly picked from the woven jute bag. A quick movement of the enemy will jeopardize six gunboats. All questions asked by five watch experts amazed the judge. Jack quietly moved up front and seized the big ball of wax. The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my</p>', 1, 1, 0),
(3, 'Happy Veterans'' Day', 1, '2015-11-11 09:29:44', '<p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.</p>  <p>His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What''s happened to me? " he thought. It wasn''t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p>  <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</p>  <p>Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn''t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.</p>  <p>He must have tried it a hundred times, shut his eyes so that he wouldn''t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I''ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there''s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch</p>', 1, 1, 1),
(4, 'Happy Thanksgiving!!!!!!!', 4, '2015-11-25 09:13:50', 'Eat lots of cranberries', 1, 1, 0),
(5, 'It&#39;s almost christmas', 4, '2015-11-25 10:56:13', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, praesentium. Libero perspiciatis quis aliquid iste quam dignissimos, accusamus temporibus ullam voluptatum, tempora pariatur, similique molestias blanditiis at sunt earum neque.\r\n Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, praesentium. Libero perspiciatis quis aliquid iste quam dignissimos, accusamus temporibus ullam voluptatum, tempora pariatur, similique molestias blanditiis at sunt earum neque.\r\n Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, praesentium. Libero perspiciatis quis aliquid iste quam dignissimos, accusamus temporibus ullam voluptatum, tempora pariatur, similique molestias blanditiis at sunt earum neque.\r\n Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, praesentium. Libero perspiciatis quis aliquid iste quam dignissimos, accusamus temporibus ullam voluptatum, tempora pariatur, similique molestias blanditiis at sunt earum neque.\r\n Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, praesentium. Libero perspiciatis quis aliquid iste quam dignissimos, accusamus temporibus ullam voluptatum, tempora pariatur, similique molestias blanditiis at sunt earum neque.\r\n', 1, 1, 1),
(8, 'strip tags test there should be no tags here ', 4, '2015-11-25 18:22:53', 'lorem <p>This should be a paragraph</p><b>bold</b>', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`user_id` mediumint(9) NOT NULL,
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `bio` text NOT NULL,
  `userpic` varchar(40) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `date_joined` datetime NOT NULL,
  `login_key` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `bio`, `userpic`, `is_admin`, `date_joined`, `login_key`) VALUES
(1, 'melissacabral@gmail.com', 'melissa', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'I love lamp', '2900c60a186f1c7c99ecc91e05e8453f02d030e9', 1, '2015-11-10 09:44:37', 'd021ca1a80ff9a48cfc8ae38f3b79139274573bc'),
(3, 'blobber@mail.com', 'blobby', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '', '', 0, '2015-11-23 09:47:35', ''),
(4, 'steeeeeve@mail.com', 'phteven', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '', '', 0, '2015-11-23 09:49:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
 ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `category_id` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
MODIFY `link_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
