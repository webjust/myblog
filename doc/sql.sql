-- 建库
CREATE DATABASE myblog;

-- 选库
USE myblog;

-- 建表：文章系统
CREATE TABLE `news`(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(30) NOT NULL,
    description VARCHAR(255) NOT NULL,
    content TEXT NOT NULL DEFAULT "",
    status TINYINT(1) NOT NULL DEFAULT 0,
    addtime INT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8;


INSERT INTO `news` (title, author, description, content, status, addtime) VALUES
('我的文章1', '作者', '文章的短描述', '文章内容', 1, 1481246108);
INSERT INTO `news` (title, author, description, content, status, addtime) VALUES
('title', '111', '222', '333', 1, 1481246108);
-- 添加测试数据
INSERT INTO `news` (title, author, description, content, status, addtime) VALUES
('我的文章1', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章2', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章3', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章4', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章5', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章6', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章7', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章8', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章10', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP()),
('我的文章9', '作者', '文章的短描述', '文章内容', 1, UNIX_TIMESTAMP());

-- 查询记录
SELECT * FROM news;

-- 创建一个用户表 user
CREATE TABLE user(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(32) NOT NULL,
	status TINYINT(1) NOT NULL DEFAULT 0,
	addtime INT NOT NULL
) engine = InnoDB DEFAULT CHARSET = UTF8;

-- 添加一个管理员
INSERT INTO user (username, password, status, addtime) VALUES("admin", md5('admin'), 1, UNIX_TIMESTAMP());