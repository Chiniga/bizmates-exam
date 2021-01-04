<p align="center">CODE EXPLANATION</p>

<p align="center">MYSQL ANSWER</p>
1. Write a query to display the ff columns ID (should start
with T + 11 digits of trn_teacher.id with leading zeros like
'T00000088424'), Nickname, Status and Roles (like
Trainer/Assessor/Staff) using table trn_teacher and
trn_teacher_role.

SELECT 
    CONCAT('T', LPAD(trn_teacher.id, 5, '0')) AS id,
    trn_teacher.nickname, 
    IF(trn_teacher.status = 1, 'Active', 'Deactivated') AS status,
    GROUP_CONCAT(
        IF(
            trn_teacher_role.role = 1, 'Trainer', IF(
                trn_teacher_role.role = 2, 'Assessor', 'Staff'
            )
        ) SEPARATOR '/'
    ) AS `role`
FROM
    trn_teacher 
    LEFT JOIN 
    trn_teacher_role 
    ON
    trn_teacher.id = trn_teacher_role.teacher_id
GROUP BY
    trn_teacher.id

2. Write a query to display the ff columns ID (from teacher.id),
Nickname, Open (total open slots from trn_teacher_time_table),
Reserved (total reserved slots from trn_teacher_time_table),
Taught (total taught from trn_evaluation) and NoShow (total
no_show from trn_evaluation) using all tables above. Should
show only those who are active (trn_teacher.status = 1 or 2)
and those who have both Trainer and Assessor role.

SELECT
    t.id,
    trn_teacher.nickname,
    (
        SELECT COUNT(*) FROM trn_teacher_time_table WHERE trn_teacher_time_table.status = 1 AND trn_teacher_time_table.teacher_id = t.id
    ) AS `open`,
    (
        SELECT COUNT(*) FROM trn_teacher_time_table WHERE trn_teacher_time_table.status = 2 AND trn_teacher_time_table.teacher_id = t.id
    ) AS `reserved`,
    (
        SELECT COUNT(*) FROM trn_evaluation WHERE trn_evaluation.result = 1 AND trn_evaluation.teacher_id = t.id
    ) AS `taught`,
    (
        SELECT COUNT(*) FROM trn_evaluation WHERE trn_evaluation.result = 2 AND trn_evaluation.teacher_id = t.id
    ) AS `noshow`,
FROM
    trn_teacher t
    LEFT JOIN
    trn_teacher_role
    ON
    trn_teacher.id = trn_teacher_role.teacher_id
WHERE
    trn_teacher.status = 1
    AND
    trn_teacher_role.role IN(1,2)
GROUP BY
    trn_teacher.id