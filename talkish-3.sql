-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2021 at 09:00 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talkish`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `readingTime` int(3) NOT NULL,
  `views` int(10) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `readingTime`, `views`, `content`, `thumbnail`, `published_at`, `author_id`) VALUES
(20, 'Stop Using REST for APIs', 'Technology', 4, 3, 'REST is an API design architecture that has become a norm for implementing web services in the last few years. It uses HTTP to get data and perform various operations (POST, GET, PUT, and DELETE) in JSON format, allowing better and faster parsing of data. \r\nHowever, like all technologies, REST API comes with some limitations. Here are some of the most common ones:\r\nIt fetches all data, whether required or not (aka “over-fetching”).\r\nIt makes multiple network requests to get multiple resources.\r\nSometimes resources are dependent, which causes waterfall network requests.\r\nTo overcome these, Facebook developed GraphQL, an open-source data query and manipulation language for APIs. Since then, GraphQL has gradually made its way into the mainstream and has become a new standard for API development. \r\nGraphQL is a syntax for requesting data. It’s a query language for APIs. The beauty, however, lies in its simplicity. It lets you specify precisely what is needed, and then it fetches just that — nothing more, nothing less. \r\nAnd it provides numerous other advantages. \r\nThe following covers some of the most compelling reasons to use GraphQL and looks at some common scenarios where GraphQL is useful.\r\nWhy Use GraphQL?\r\nStrongly-Typed Schema\r\nAll the data types (such as Boolean, String, Int, Float, ID, Scalar) supported by the API are specified in the schema in the GraphQL Schema Definition Language (SDL), which helps determine the data that is available and the form in which it exists. This strongly-typed schema makes GraphQL less error-prone and provides additional validation. GraphQL also provides auto-completion for supported IDEs and code editors. \r\nFetch Only Requested Data (No Over- or Under-Fetching)\r\nWith GraphQL, developers can fetch exactly what is required. Nothing less, nothing more. The ability to deliver only requested data solves the issues that arise due to over-fetching and under-fetching. \r\nOver-fetching happens when the response fetches more than is required. Consider the example of a blog home page. It displays the list of all blog posts (just the title and URLs). However, to present this list, you need to fetch all the blog posts (along with body data, images, etc.) through the API, and then show just what is required, usually through UI code. This over-fetching impacts your app’s performance and consumes more data, which is expensive for the user. \r\nWith GraphQL, you define the fields that you want to fetch (i.e., Title and URL, in this case), and it fetches the data of only these fields. \r\nUnder-fetching, on the other hand, is not fetching adequate data in a single API request. In this case, you need to make additional API requests to get related or referenced data. For instance, while displaying an individual blog post, you also need to fetch the referenced author’s profile entry so that you can display the author’s name and bio. \r\nGraphQL handles this well. It lets you fetch all relevant data in a single query.   \r\nSaves Time and Bandwidth\r\nGraphQL allows multiple resource requests in a single query call, which saves time and bandwidth by reducing the number of network round trips to the server. It also helps to prevent waterfall network requests, where you need to resolve dependent resources on previous requests. For example, consider a blog’s homepage where you need to display multiple widgets, such as recent posts, the most popular posts, categories, and featured posts. With REST architecture, displaying these would take at least five requests, while a similar scenario using GraphQL requires just a single GraphQL request.\r\nSchema Stitching for Combining Schemas\r\nSchema stitching allows combining multiple, different schemas into a single schema. In a microservices architecture, where each microservice handles the business logic and data for a specific domain, this is very useful. Each microservice can define its GraphQL schema, after which you use schema stitching to weave them into one schema accessible by the client.\r\nVersioning is Not Required\r\nIn REST architecture, developers create new versions (e.g., api.domain.com/v1/, api.domain.com/v2/) due to changes in resources or the request/response structure of the resources over time. Hence, maintaining versions is a common practice. With GraphQL, there is no need to maintain versions. The resource URL or address remains the same. You can add new fields and deprecate older fields. This approach is intuitive as the client receives a deprecation warning when querying a deprecated field. \r\nTransform Fields and Resolve with Required Shape\r\nA user can define an alias for fields, and each of the fields can be resolved into different values. Consider an image transformation API, where a user wants to transform multiple types of images using GraphQL. The query looks like this:', '../images/tk_6087239924001-1619469209.jpg', '2021-04-26 20:33:29', 1),
(23, 'Best Web Development Frameworks In 2021', 'Technology', 1, 0, 'Some Content Should Come here', '../images/tk_60872972d635d-1619470706.jpg', '2021-04-26 20:58:26', 2),
(24, 'Business Tips Vol. 2', 'Business', 1, 0, 'Such Empty Here. This might be a simple placeholder; who knows?', '../images/tk_60872a0651803-1619470854.jpg', '2021-04-26 21:00:54', 2),
(25, '5 Tips For A Healthier Life', 'Health', 3, 1, '1. Don’t drink sugar calories Sugary drinks are among the most fattening items you can put into your body.  This is because your brain doesn’t measure calories from liquid sugar the same way it does for solid food (1Trusted Source).  Therefore, when you drink soda, you end up eating more total calories (2Trusted Source, 3Trusted Source).  Sugary drinks are strongly associated with obesity, type 2 diabetes, heart disease, and many other health problems (4Trusted Source, 5Trusted Source, 6Trusted Source, 7Trusted Source).  Keep in mind that certain fruit juices may be almost as bad as soda in this regard, as they sometimes contain just as much sugar. Their small amounts of antioxidants do not negate the sugar’s harmful effects (8Trusted Source).  2. Eat nuts Despite being high in fat, nuts are incredibly nutritious and healthy.  They’re loaded with magnesium, vitamin E, fiber, and various other nutrients (9Trusted Source).  Studies demonstrate that nuts can help you lose weight and may help fight type 2 diabetes and heart disease (10Trusted Source, 11Trusted Source, 12Trusted Source).  Additionally, your body doesn’t absorb 10–15% of the calories in nuts. Some evidence also suggests that this food can boost metabolism (13Trusted Source).  In one study, almonds were shown to increase weight loss by 62%, compared with complex carbs (14Trusted Source).   3. Avoid processed junk food (eat real food instead) Processed junk food is incredibly unhealthy.  These foods have been engineered to trigger your pleasure centers, so they trick your brain into overeating — even promoting food addiction in some people (15Trusted Source).  They’re usually low in fiber, protein, and micronutrients but high in unhealthy ingredients like added sugar and refined grains. Thus, they provide mostly empty calories.  4. Don’t fear coffee Coffee is very healthy.  It’s high in antioxidants, and studies have linked coffee intake to longevity and a reduced risk of type 2 diabetes, Parkinson’s and Alzheimer’s diseases, and numerous other illnesses (16Trusted Source, 17Trusted Source, 18Trusted Source, 19, 20, 21Trusted Source).  5. Eat fatty fish Fish is a great source of high-quality protein and healthy fat.  This is particularly true of fatty fish, such as salmon, which is loaded with omega-3 fatty acids and various other nutrients (22Trusted Source).  Studies show that people who eat the most fish have a lower risk of several conditions, including heart disease, dementia, and depression (23Trusted Source, 24Trusted Source, 25).', '../images/tk_60872aafbf3f5-1619471023.jpg', '2021-04-26 21:03:43', 2),
(26, 'Donald Trump makes his debut in National Portrait Gallery’s presidents exhibition', 'Politics', 2, 11, 'When the National Portrait Gallery reopens May 14, visitors will have the first opportunity to see a President Donald Trump portrait in the popular America’s Presidents exhibition.\r\nPari Dukovic’s photograph of the former president depicts him seated in the Oval Office behind the Resolute Desk. It has taken the place of Kehinde Wiley’s portrait of President Barack Obama, which, starting in June, will go on a year-long, five-city tour with Amy Sherald’s painting of former first lady Michelle Obama. Shepard Fairey’s “Hope,” a collage acquired by the gallery in 2008, replaces the Wiley painting.\r\n“There’s always a sense of transition when we install a new presidential portrait,” Dorothy Moss, the gallery’s curator of painting and sculpture, said of the exhibit. “We are a museum that reflects art history and biography, and we are able to celebrate the presidents with portraits that are historical documents.”\r\n\r\nThe Smithsonian museum has been closed since Nov. 23 because of the coronavirus pandemic, delaying the traditional post-inaugural update to the presidents gallery.\r\n‘Pretty sharp,’ says Obama of his presidential portrait\r\nDukovic took the photograph on June 17, 2019, for Time magazine. It is the newest portrait of Trump in the National Portrait Gallery’s permanent collection, joining four others that predate his presidency, said Leslie Ureña, curator of photographs. Dukovic’s photograph will be on view while the official Trump portrait is being completed. The museum is not sharing details of that commission nor on the one of former first lady Melania Trump, except to say that the process is underway.\r\n', '../images/tk_60872b668dbd9-1619471206.jpg', '2021-04-26 21:06:46', 3),
(28, 'Birds all around the world', 'Health', 1, 1, 'Păsările zboară și sunt frumoase', '../images/tk_60891eea8e75c-1619599082.jpg', '2021-04-28 08:38:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(50) NOT NULL,
  `blog_id` bigint(50) NOT NULL,
  `user_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `blog_id`, `user_id`) VALUES
(6, 18, 1),
(9, 26, 3),
(10, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `role`, `password`) VALUES
(1, 'Admin', 'User', 'admin@test.com', 'admin', '$2y$10$HTiyFO6hrSOhDhH4pFik8ODqwIbhEdSxJoCRmQq2ccs0yQusUo5/W'),
(2, 'Vlad', 'Mihet', 'vlad.mihet@yahoo.com', 'user', '$2y$10$73atJwFsaHkG0iDhLqWnr.eqcSzXWsvh9cAQuA.tnqDE381/6wJq6'),
(3, 'John', 'McKartney', 'John', 'user', '$2y$10$dpJVrIvJOvokHuncBBmxpeQ.sVwZF8eJgQuGGQUAG60kz1plzkT4u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
