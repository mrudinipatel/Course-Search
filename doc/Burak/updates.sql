UPDATE Course 
SET Description=(SELECT Description FROM allData WHERE Course.id=allData.id);

UPDATE Course
SET Prerequisites='(CIS*3750^|^CIS*3760)^&^(CIS*2460^|^STAT*2040)'
WHERE CourseID = 'CIS*3700';

UPDATE Course
SET Prerequisites='CIS*3110^&^(CIS*3750^|^CIS*3760^|^ENGG*4450)'
WHERE CourseID = 'CIS*4300';

UPDATE Course
SET Prerequisites='CIS*3490^&^(CIS*3750^|^CIS*3760)^&^(CIS*2460^|^STAT*2040)'
WHERE CourseID = 'CIS*4780';

UPDATE Course
SET Prerequisites='9.00^&^CIS*2520^&^(CIS*2430^|^ENGG*1420)'
WHERE CourseID = 'CIS*3750';
