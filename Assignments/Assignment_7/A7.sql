/* Display albums that have the letters “on” somewhere in the album title. Sort results in alphabetical order by album
   title. */
SELECT *
FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

/* Same as #1, but only show album title and artist name (no artist_id) columns. */
SELECT title, name
FROM albums
JOIN artists a
    ON a.artist_id = albums.artist_id
WHERE title LIKE '%on%'
ORDER BY title;

/* Display tracks that have AAC audio file format. Only show track name (alias: track_name), composer, media type name
   (alias: media_type), and unit price columns.
   Use media_type_id column for comparison instead of media type name.*/
SELECT tracks.name track_name, tracks.composer, mt.name media_type, tracks.unit_price
FROM tracks
JOIN media_types mt
    ON mt.media_type_id = tracks.media_type_id
WHERE tracks.media_type_id = 5;

/* Display R&B/Soul and Jazz tracks that have a composer (not NULL). Sort results in reverse-alphabetical order by track
   name. Only show track ID, track name (track_name), composer, milliseconds, and genre name (genre_name) columns.
   Use genre_id column for comparison instead of genre name.*/
SELECT tracks.track_id, tracks.name track_name, tracks.composer, tracks.milliseconds, g.name genre_name
FROM tracks
JOIN genres g
    ON g.genre_id = tracks.genre_id
WHERE tracks.composer IS NOT NULL
    AND (tracks.genre_id = 2
    OR tracks.genre_id = 14)
ORDER BY tracks.name DESC;

/* Display drama (genre) DVDs that won awards. Sort results by year of when the DVD won an award. Show dvd title, award,
   genre, label, and rating. */
SELECT dvd_titles.title, dvd_titles.award, g.genre, l.label, r.rating
FROM dvd_titles
JOIN genres g
    ON g.genre_id = dvd_titles.genre_id
JOIN labels l
    ON l.label_id = dvd_titles.label_id
JOIN ratings r
    ON r.rating_id = dvd_titles.rating_id
WHERE award IS NOT NULL
    AND dvd_titles.genre_id = 9
ORDER BY dvd_titles.award;

/* Display DVDs made by Universal (a label) and have DTS sound. Show dvd title, sound, label, genre, and rating. */
SELECT dvd_titles.title, s.sound, l.label, g.genre, r.rating
FROM dvd_titles
JOIN sounds s
    ON s.sound_id = dvd_titles.sound_id
JOIN labels l
    ON l.label_id = dvd_titles.label_id
JOIN genres g
    ON g.genre_id = dvd_titles.genre_id
JOIN ratings r
    ON r.rating_id = dvd_titles.rating_id
WHERE dvd_titles.sound_id = 4
    AND dvd_titles.label_id = 127;

/* Display R-rated Sci-Fi DVDs that have a release date (not NULL). Order results from newest to oldest released DVD.
   Show dvd title, release date, rating, genre, sound, and label. */
SELECT dvd_titles.title, dvd_titles.release_date, r.rating, g.genre, s.sound, l.label
FROM dvd_titles
JOIN ratings r
    ON r.rating_id = dvd_titles.rating_id
JOIN genres g
    ON g.genre_id = dvd_titles.genre_id
JOIN sounds s
    ON s.sound_id = dvd_titles.sound_id
JOIN labels l
    ON l.label_id = dvd_titles.label_id
WHERE dvd_titles.release_date IS NOT NULL
    AND dvd_titles.rating_id = 7
    AND dvd_titles.genre_id = 19
ORDER BY dvd_titles.release_date DESC;



