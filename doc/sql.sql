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