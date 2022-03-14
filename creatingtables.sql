

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `current_price` int(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `image_name`, `image_path`, `current_price`, `quantity`) VALUES
(7, 'Guangzhou sweater', 'fashi/img/products/product-2.jpg', 13, 1),
(6, 'Pure Pineapple', 'fashi/img/products/product-1.jpg', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `current_price` varchar(255) NOT NULL,
  `initial_price` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `image_name`, `image_path`, `category`, `current_price`, `initial_price`) VALUES
(1, 'Pure Pineapple', 'fashi/img/products/product-1.jpg', 'Towel', '14.00', '35.00'),
(2, 'Guangzhou sweater', 'fashi/img/products/product-2.jpg', 'Coat', '13.00', '35.00'),
(3, 'Guangzhou sweater', 'fashi/img/products/product-3.jpg', 'Shoes', '34.00', '35.00'),
(4, 'Microfiber Wool Scarf', 'fashi/img/products/product-4.jpg', 'Coat', '64.00', '100.00'),
(5, 'Mens Painted Hat', 'fashi/img/products/product-5.jpg', 'Shoes', '44.00', '35.00'),
(6, 'Converse Shoes', 'fashi/img/products/product-6.jpg', 'Shoes', '34.00', '35.00'),
(7, 'Pure Pineapple', 'fashi/img/products/product-7.jpg', 'Bag', '64.00', '35.00'),
(8, '2 Layer Windbreaker', 'fashi/img/products/product-8.jpg', 'Coat', '44.00', '35.00'),
(9, 'Converse Shoes', 'fashi/img/products/product-9.jpg', 'Shoes', '34.00', '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Kylian', 'amos12@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
