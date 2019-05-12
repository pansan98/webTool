-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 5 月 10 日 00:02
-- サーバのバージョン： 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `applications`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `applications_capture`
--

CREATE TABLE `applications_capture` (
  `id` int(11) NOT NULL COMMENT 'URLで基本制御',
  `user_id` int(11) NOT NULL COMMENT '紐づけ',
  `capture_created` datetime DEFAULT NULL COMMENT '作成日',
  `capture_url` longtext COMMENT '生成URL',
  `capture_filename` longtext NOT NULL COMMENT 'ファイルネーム',
  `capture_deleted` int(11) NOT NULL DEFAULT '0' COMMENT 'バックアップ',
  `capture_copy` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `applications_user`
--

CREATE TABLE `applications_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL COMMENT 'ユーザーID',
  `user_password` longtext NOT NULL COMMENT 'ユーザーパスワード',
  `user_name` varchar(100) NOT NULL COMMENT 'ユーザーネーム',
  `user_created` datetime DEFAULT NULL COMMENT '作成日',
  `user_deleted` int(1) DEFAULT '0' COMMENT '存在有無',
  `user_updated` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `user_room_id` longtext COMMENT 'ルームID',
  `user_last_login` datetime DEFAULT NULL COMMENT '最終ログイン日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザー情報';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications_capture`
--
ALTER TABLE `applications_capture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `applications_user`
--
ALTER TABLE `applications_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications_capture`
--
ALTER TABLE `applications_capture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'URLで基本制御', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `applications_user`
--
ALTER TABLE `applications_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
