SELECT 

COUNT(COUNT) AS COUNT, 

(
SELECT hour_started AS hour_end FROM limits WHERE FIRST = 1  AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' ORDER BY created_at DESC LIMIT 1
) AS hour_started,

(
SELECT hour_started AS hour_end FROM limits WHERE FIRST = 0  AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' ORDER BY created_at DESC LIMIT 1
) AS hour_last,

(
SELECT hour_started + 3600 AS hour_end FROM limits WHERE FIRST = 1  AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' ORDER BY created_at DESC LIMIT 1
) AS hour_end


FROM limits WHERE 
-- first = 0 AND 
hour_started >= (
SELECT hour_started AS hour_end FROM limits WHERE FIRST = 1  AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' ORDER BY created_at DESC LIMIT 1
)
AND
hour_started < (
SELECT hour_started + 3600 AS hour_end FROM limits WHERE FIRST = 1  AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' ORDER BY created_at DESC LIMIT 1
)

AND api_key = 'pul' AND controller LIKE '%Mahasiswa%'
AND uri LIKE '%get%' 

ORDER BY created_at DESC LIMIT 1