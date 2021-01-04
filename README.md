<p align="center"><strong>CODE EXPLANATION</strong></p>
Laravel Version: 8<br/>
PHP Version: 8<br/>
Tools used: Docker, Sail
<br/>
My code UI and UX are best simply because
the app is easy to use and to look at. It provides all the information they need with no wasted data.
The user can also check the weather 5 days in advance which is very helpful for planning ahead.

As you can see, the weather is shown first since this is a weather app and people expect to see the weather conditions.
After the weather is some helpful information about the places to visit within the desired city.

<p align="center"><strong>MYSQL ANSWERS</strong></p>
1. Write a query to display the ff columns ID (should start
with T + 11 digits of trn_teacher.id with leading zeros like
'T00000088424'), Nickname, Status and Roles (like
Trainer/Assessor/Staff) using table trn_teacher and
trn_teacher_role.

<pre><code>
SELECT 
    CONCAT('T', LPAD(trn_teacher.id, 5, '0')) AS id,
    trn_teacher.nickname, 
    IF(
        trn_teacher.status = 1, 'Active', IF(
            trn_teacher.status = 2, 'Deactivated', 'Discontinued'
        )
    ) AS status,
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
</code></pre>

2. Write a query to display the ff columns ID (from teacher.id),
Nickname, Open (total open slots from trn_teacher_time_table),
Reserved (total reserved slots from trn_teacher_time_table),
Taught (total taught from trn_evaluation) and NoShow (total
no_show from trn_evaluation) using all tables above. Should
show only those who are active (trn_teacher.status = 1 or 2)
and those who have both Trainer and Assessor role.

<pre><code>
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
    INNER JOIN
    trn_teacher_role role1
    ON
    trn_teacher.id = role1.teacher_id AND role1.role = 1
    INNER JOIN
    trn_teacher_role role2
    ON
    trn_teacher.id = role2.teacher_id AND role2.role = 2
WHERE
    trn_teacher.status = 1
    AND
    trn_teacher_role.role IN(1,2)
</code></pre>