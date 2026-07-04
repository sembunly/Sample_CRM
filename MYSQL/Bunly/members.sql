-- ==========================================
-- Table: members
-- status: 1 = active, 2 = old edited data, 0 = deleted
-- ==========================================

CREATE TABLE members (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    dob DATE NOT NULL,
    join_date DATE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL,
    address TEXT,
    status TINYINT(1) NOT NULL DEFAULT 1 COMMENT '0=Deleted, 1=Active, 2=Edited',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;5

-- ==========================================
-- Insert Sample Data
-- ==========================================
INSERT INTO members
(first_name, last_name, gender, dob, join_date, phone, email, address, status)
VALUES
('John Dongku', 'Smith', 'Male', '1995-05-10', '2024-01-15', '012345678', 'john.smith@gmail.com', 'Phnom Penh', 1),
('Mary', 'Johnson', 'Female', '1998-08-20', '2024-02-01', '098765432', 'mary.johnson@gmail.com', 'Siem Reap', 1),
('David', 'Brown', 'Male', '1992-03-12', '2024-02-10', '011223344', 'david.brown@gmail.com', 'Battambang', 1),
('Linda', 'Davis', 'Female', '1997-11-05', '2024-03-01', '015667788', 'linda.davis@gmail.com', 'Kampot', 1),
('Michael', 'Wilson', 'Male', '1990-07-25', '2024-03-15', '017889900', 'michael.wilson@gmail.com', 'Takeo', 1),
('Sarah', 'Taylor', 'Female', '1996-04-18', '2024-04-01', '010112233', 'sarah.taylor@gmail.com', 'Kandal', 1),
('James', 'Anderson', 'Male', '1993-09-30', '2024-04-20', '016445566', 'james.anderson@gmail.com', 'Kampong Cham', 1),
('Emma', 'Thomas', 'Female', '1999-01-22', '2024-05-05', '018778899', 'emma.thomas@gmail.com', 'Prey Veng', 1),
('Robert', 'Moore', 'Male', '1991-12-14', '2024-05-25', '013334455', 'robert.moore@gmail.com', 'Pursat', 1),
('Sophia', 'Martin', 'Female', '2000-06-08', '2024-06-10', '014556677', 'sophia.martin@gmail.com', 'Sihanoukville', 1),
('Bunly', 'Sok', 'Male', '1994-02-16', '2024-07-01', '012111222', 'bunly.sok@gmail.com', 'Phnom Penh', 1),
('Dara', 'Chan', 'Male', '1997-10-11', '2024-07-05', '012333444', 'dara.chan@gmail.com', 'Kandal', 1);
