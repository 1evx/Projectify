-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 07:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectify`
--

-- --------------------------------------------------------

--
-- Table structure for table `appendix`
--

CREATE TABLE `appendix` (
  `AppendixID` int(11) NOT NULL,
  `Filename` varchar(200) NOT NULL,
  `Filetype` varchar(50) NOT NULL,
  `Filesize` int(11) NOT NULL,
  `Filecontent` blob NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appendix`
--

INSERT INTO `appendix` (`AppendixID`, `Filename`, `Filetype`, `Filesize`, `Filecontent`, `Timestamp`, `UserID`) VALUES
(1, 'T4_Vulnerability Scanning.docx', 'application/vnd.openxmlformats-officedocument.word', 197560, 0x75736572646174612f54345f56756c6e65726162696c697479205363616e6e696e672e646f6378, '2024-06-07 09:52:43', 1),
(2, 'T4_nmap cheat sheet.pdf', 'application/pdf', 95134, 0x75736572646174612f54345f6e6d61702063686561742073686565742e706466, '2024-06-07 09:52:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `ChanID` int(11) NOT NULL,
  `ChannelCode` varchar(50) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `OwnerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`ChanID`, `ChannelCode`, `Title`, `Description`, `ImageID`, `OwnerID`) VALUES
(1, 'EiWE0u', 'Aurora Seeking', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `ForumID` int(11) NOT NULL,
  `Topic` varchar(50) NOT NULL,
  `Content` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `HostID` int(11) NOT NULL,
  `ImageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`ForumID`, `Topic`, `Content`, `Timestamp`, `HostID`, `ImageID`) VALUES
(2, 'Aurora Seeking', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2024-06-28 07:20:45', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `forum_message`
--

CREATE TABLE `forum_message` (
  `ForumID` int(11) NOT NULL,
  `MessageID` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_message`
--

INSERT INTO `forum_message` (`ForumID`, `MessageID`, `Status`) VALUES
(2, 3, ''),
(2, 4, ''),
(2, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `Filename` varchar(255) NOT NULL,
  `Filepath` varchar(255) NOT NULL,
  `Uploaddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageID`, `Filename`, `Filepath`, `Uploaddate`) VALUES
(1, 'Profile', 'userdata/666147843c879_cover-9523249536299097.png', '2024-06-06 05:22:12'),
(2, 'Profile', 'userdata/6661479e518a2_cover-997540817151269.png', '2024-06-06 05:22:38'),
(3, 'Profile', 'userdata/6661487c8a423_cover-6158947652533107.png', '2024-06-06 05:26:20'),
(4, 'Profile', 'userdata/667b8e892d0cd_ce18f12842fdd9960e0fcc3d8e3feeed.jpg', '2024-06-26 03:44:09'),
(5, 'Profile', 'userdata/667e644d08af9_Screenshot 2024-06-24 235931.png', '2024-06-28 07:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `InstitutionID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `ImageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`InstitutionID`, `Name`, `Address`, `Location`, `ImageID`) VALUES
(1, 'University of Example', '123 Example St, Example City', 'Example Country', NULL),
(2, 'Institute of Learning', '456 Knowledge Rd, Knowledge City', 'Knowledge Country', NULL),
(3, 'Academy of Education', '789 Education Blvd, Education City', 'Education Country', NULL),
(4, 'School of Advanced Studies', '101 Research Ave, Research Town', 'Research Country', NULL),
(5, 'College of Innovation', '202 Innovation St, Innovation Village', 'Innovation Country', NULL),
(6, 'Center for Academic Excellence', '303 Excellence Ln, Excellence City', 'Excellence Country', NULL),
(7, 'Tech University', '404 Technology Dr, Tech City', 'Tech Country', NULL),
(8, 'Global Learning Institute', '505 Global Blvd, Global City', 'Global Country', NULL),
(9, 'International University', '606 International Rd, International Town', 'International Country', NULL),
(10, 'Science and Arts College', '707 Science St, Science City', 'Science Country', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `MaterialID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` text DEFAULT NULL,
  `Filename` varchar(200) NOT NULL,
  `Filetype` varchar(50) NOT NULL,
  `Filesize` int(11) NOT NULL,
  `Filecontent` blob NOT NULL,
  `ChanID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`MaterialID`, `Title`, `Description`, `Filename`, `Filetype`, `Filesize`, `Filecontent`, `ChanID`, `Timestamp`) VALUES
(1, 'Introduction To Artificial Intelligence Assignment Guideline', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Assignment Question IAI _2024.pdf', 'application/pdf', 173445, 0x75736572646174612f41737369676e6d656e74205175657374696f6e20494149205f323032342e706466, 1, '2024-06-06 05:29:55'),
(2, 'Aurora Seeking', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'AI Group 19 Final Documentation.docx', 'application/vnd.openxmlformats-officedocument.word', 154968, 0x75736572646174612f41492047726f75702031392046696e616c20446f63756d656e746174696f6e2e646f6378, 1, '2024-06-06 06:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageID` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `SenderID` int(11) NOT NULL,
  `ReceiverID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageID`, `Content`, `Timestamp`, `SenderID`, `ReceiverID`) VALUES
(1, '😘', '2024-06-08 08:48:11', 1, 2),
(3, 'halo你好吗', '2024-06-28 07:22:37', 1, NULL),
(4, 'halo你好吗', '2024-06-28 07:22:46', 1, NULL),
(5, 'halo', '2024-06-28 07:39:10', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Name`, `Description`) VALUES
(1, 'Admin', 'System administrator with full access'),
(2, 'Student', 'Student role with access to coursework and resources'),
(3, 'Lecturer', 'Lecturer role responsible for teaching and course management');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Deadline` date NOT NULL,
  `ChanID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskID`, `Title`, `Description`, `Deadline`, `ChanID`) VALUES
(1, 'Introduction To Artificial Intelligence Assignment Guideline', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2024-07-25', 1),
(2, 'Aurora Seeking', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2024-07-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `IC` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Age` varchar(50) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Name`, `IC`, `Password`, `Email`, `Age`, `Gender`, `RoleID`, `ImageID`) VALUES
(1, 'Tan Po Yeh', '040525-01-0313', '123', 'poyehtan@gmail.com', '20', 'male', 2, 1),
(2, 'Lew Wei How', '040302-14-1111', '123', 'weihow@gmail.com', '20', 'male', 3, 2),
(4, 'Admin', '040404-14-1111', '123', 'admin@gmail.com', '23', 'male', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_channel`
--

CREATE TABLE `user_channel` (
  `ChanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `GroupNumber` varchar(50) NOT NULL,
  `GroupIndex` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_channel`
--

INSERT INTO `user_channel` (`ChanID`, `MemberID`, `Title`, `GroupNumber`, `GroupIndex`) VALUES
(1, 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_institution`
--

CREATE TABLE `user_institution` (
  `InstitutionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `DateRemoved` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_institution`
--

INSERT INTO `user_institution` (`InstitutionID`, `UserID`, `Status`, `DateAdded`, `DateRemoved`) VALUES
(3, 4, 'Pending', '2024-06-26 03:44:09', NULL),
(4, 2, 'Pending', '2024-06-06 05:22:38', NULL),
(6, 1, 'Pending', '2024-06-06 05:22:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE `user_task` (
  `TaskID` int(11) NOT NULL,
  `AppendixID` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Score` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_task`
--

INSERT INTO `user_task` (`TaskID`, `AppendixID`, `Status`, `Score`) VALUES
(1, 2, 'Submitted', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appendix`
--
ALTER TABLE `appendix`
  ADD PRIMARY KEY (`AppendixID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`ChanID`),
  ADD KEY `ImageID` (`ImageID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ForumID`),
  ADD KEY `HostID` (`HostID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- Indexes for table `forum_message`
--
ALTER TABLE `forum_message`
  ADD PRIMARY KEY (`ForumID`,`MessageID`),
  ADD KEY `MessageID` (`MessageID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`InstitutionID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`MaterialID`),
  ADD KEY `ChanID` (`ChanID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `ChanID` (`ChanID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- Indexes for table `user_channel`
--
ALTER TABLE `user_channel`
  ADD PRIMARY KEY (`ChanID`,`MemberID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `user_institution`
--
ALTER TABLE `user_institution`
  ADD PRIMARY KEY (`InstitutionID`,`UserID`),
  ADD KEY `InstitutionID` (`InstitutionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `user_task`
--
ALTER TABLE `user_task`
  ADD PRIMARY KEY (`TaskID`,`AppendixID`),
  ADD KEY `AppendixID` (`AppendixID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appendix`
--
ALTER TABLE `appendix`
  MODIFY `AppendixID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `ChanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `ForumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `InstitutionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appendix`
--
ALTER TABLE `appendix`
  ADD CONSTRAINT `appendix_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`ImageID`) REFERENCES `image` (`ImageID`),
  ADD CONSTRAINT `channel_ibfk_2` FOREIGN KEY (`OwnerID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`HostID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`ImageID`) REFERENCES `image` (`ImageID`);

--
-- Constraints for table `forum_message`
--
ALTER TABLE `forum_message`
  ADD CONSTRAINT `forum_message_ibfk_1` FOREIGN KEY (`ForumID`) REFERENCES `forum` (`ForumID`),
  ADD CONSTRAINT `forum_message_ibfk_2` FOREIGN KEY (`MessageID`) REFERENCES `message` (`MessageID`);

--
-- Constraints for table `institution`
--
ALTER TABLE `institution`
  ADD CONSTRAINT `institution_ibfk_1` FOREIGN KEY (`ImageID`) REFERENCES `image` (`ImageID`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`ChanID`) REFERENCES `channel` (`ChanID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`ChanID`) REFERENCES `channel` (`ChanID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`ImageID`) REFERENCES `image` (`ImageID`);

--
-- Constraints for table `user_channel`
--
ALTER TABLE `user_channel`
  ADD CONSTRAINT `user_channel_ibfk_1` FOREIGN KEY (`ChanID`) REFERENCES `channel` (`ChanID`),
  ADD CONSTRAINT `user_channel_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `user_institution`
--
ALTER TABLE `user_institution`
  ADD CONSTRAINT `user_institution_ibfk_1` FOREIGN KEY (`InstitutionID`) REFERENCES `institution` (`InstitutionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_institution_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `user_task`
--
ALTER TABLE `user_task`
  ADD CONSTRAINT `user_task_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `task` (`TaskID`),
  ADD CONSTRAINT `user_task_ibfk_2` FOREIGN KEY (`AppendixID`) REFERENCES `appendix` (`AppendixID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
