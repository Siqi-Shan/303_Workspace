/* Create a view mpeg_tracks that displays all tracks with MPEG audio file format. Display track name (track_name)
   artist name (artist_name), composer, album title (album_title), and media type (media_type). Sort results in
   alphabetical order by track name. */
CREATE OR REPLACE VIEW mpeg_tracks AS
    SELECT tracks.name track_name, a2.name artist_name, tracks.composer, a1.title album_title, mt.name media_type
    FROM tracks
    JOIN albums a1
        ON a1.album_id = tracks.album_id
    JOIN artists a2
        ON a1.artist_id = a2.artist_id
    JOIN media_types mt
        ON mt.media_type_id = tracks.media_type_id
    WHERE tracks.media_type_id = 1
    ORDER BY tracks.name;

/* Add a track below to the database: */
INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price)
VALUES ('The Ocean', 137, 1, 1, 'John Bonham/John Paul Jones/Robert Plant', 248000, 7990000, 0.99);

/* Make the following changes to the track added above: */
UPDATE tracks
SET bytes = 8998765, unit_price = 1.99
WHERE track_id = 3504;

/* Delete track 20 Flight Rock by BackBeat from the database. */
DELETE FROM playlist_track
WHERE track_id = 122;

DELETE FROM tracks
WHERE track_id = 122;

/* Display how many tracks there are for each album. Show album ID, album title (album_title), and track count
   (track_count). */
SELECT tracks.album_id, a.title album_title, COUNT(*) track_count
FROM tracks
JOIN albums a
    ON a.album_id = tracks.album_id
GROUP BY tracks.album_id;
