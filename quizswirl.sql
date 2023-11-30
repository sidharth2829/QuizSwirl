-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 06:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizswirl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_quiz`
--

CREATE TABLE `admin_quiz` (
  `admin_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_quiz`
--

INSERT INTO `admin_quiz` (`admin_id`, `quiz_id`) VALUES
(1, 1),
(1, 5),
(1, 6),
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'Sidharth', 'Sidh12345', '2023-11-29 16:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `quiz_date` date NOT NULL,
  `quiz_subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_name`, `quiz_date`, `quiz_subject`) VALUES
(1, 'Math Quiz', '2023-11-30', 'Mathematics'),
(2, 'Science Quiz', '2023-12-05', 'Physics'),
(3, 'History Quiz', '2023-12-10', 'World History'),
(4, 'English_Test', '2023-11-02', 'English'),
(5, 'English_Test', '2023-11-02', 'English'),
(6, 'Random', '2023-11-09', 'English'),
(7, 'Random 2 ', '2023-11-08', 'maths'),
(8, '1', '2023-11-16', '2'),
(9, '1', '2023-11-16', '2'),
(10, '1', '2023-11-16', '2'),
(11, '1', '2023-11-16', '2'),
(12, '1', '2023-11-16', '2'),
(13, '1', '2023-11-16', '2'),
(14, 'R', '2023-11-02', '1'),
(15, 'R', '2023-11-02', 'hello'),
(16, 'R', '2023-11-02', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `wrong_answer1` varchar(255) NOT NULL,
  `wrong_answer2` varchar(255) NOT NULL,
  `wrong_answer3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_text`, `correct_answer`, `wrong_answer1`, `wrong_answer2`, `wrong_answer3`) VALUES
(1, 1, 'Who wrote the play \"Romeo and Juliet\"?', 'William Shakespeare', 'Charles Dickens', 'Jane Austen', 'Mark Twain'),
(2, 1, 'Which famous scientist developed the theory of general relativity?', 'Albert Einstein', 'Isaac Newton', 'Galileo Galilei', 'Charles Darwin'),
(3, 1, 'Which country is famous for the martial art known as Karate?', 'Japan', 'China', 'Brazil', 'India'),
(4, 1, 'Who is the author of the Harry Potter book series?', 'J.K. Rowling', 'J.R.R. Tolkien', 'George Orwell', 'Agatha Christie'),
(5, 1, 'Which of the following programming languages is often used for data analysis and scientific computing?', 'Python', 'Java', 'C++', 'Ruby'),
(6, 1, 'What is the largest mammal in the world?', 'Blue whale', 'Elephant', 'Giraffe', 'Lion'),
(7, 1, 'Which gas do plants absorb from the atmosphere during photosynthesis?', 'Carbon dioxide', 'Oxygen', 'Nitrogen', 'Hydrogen'),
(8, 1, 'Who painted the Mona Lisa?', 'Leonardo da Vinci', 'Pablo Picasso', 'Vincent van Gogh', 'Michelangelo'),
(9, 1, 'What is the largest planet in our solar system?', 'Jupiter', 'Earth', 'Mars', 'Venus'),
(10, 1, 'Who is the Greek god of the sea?', 'Poseidon', 'Zeus', 'Hades', 'Apollo');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`firstname`, `lastname`, `username`, `email`, `password`, `contact`) VALUES
('Sidharth', 'Grover', 'sidh28', 'sidharthgrover28@gmail.com', 'Sidh12345', '9927307000'),
('Pankhuri', 'Asthana', 'pankhu28', '22103202@gmail.com', '1234', '9927307000');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `username` varchar(20) NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `wrong_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`username`, `correct_answer`, `wrong_answer`) VALUES
('sidh28', 10, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_quiz`
--
ALTER TABLE `admin_quiz`
  ADD PRIMARY KEY (`admin_id`,`quiz_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_quiz`
--
ALTER TABLE `admin_quiz`
  ADD CONSTRAINT `admin_quiz_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`admin_id`),
  ADD CONSTRAINT `admin_quiz_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
