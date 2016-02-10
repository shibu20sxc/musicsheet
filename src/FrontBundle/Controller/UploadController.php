<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class UploadController extends Controller {

    public function indexAction(Request $request) {
        $conn = $this->get('database_connection');
        $candateDetails = $this->get('session')->get('users_session');
        if (!empty($candateDetails)) {
            $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');
            $instrumentFamily = json_encode($conn->fetchAll('SELECT * FROM music_family WHERE status = 1 AND is_deleted = 1'));
            $instruments = json_encode($conn->fetchAll('SELECT * FROM family_sound WHERE status = 1 AND is_deleted = 1'));
            $user_info = array();
            if (!empty($subscribed_user_id)) {
                foreach ($subscribed_user_id as $key => $sub_id) {
                    $subid_array[$key] = $sub_id['subscription_user_id'];
                }
                $condition = '';
                if (!empty($subid_array)) {
                    $condition = implode(',', $subid_array);
                }

                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
            }
            $json_user_info = json_encode($user_info);
            $userDetails = $this->get('session')->get('users_session');
            $user_name = $userDetails['login_users_name'];
            $info = $conn->fetchAll('SELECT * FROM log_info where status = "1" AND is_deleted = "1" order by id DESC ');
            $advertisement1 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 1 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement2 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 2 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement3 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 3 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement4 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 4 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $songs = json_encode($conn->fetchAll('SELECT * FROM songs where user_id = ' . $userDetails['login_users_id'] . ' AND published = "1" AND status = "1" AND is_deleted = "1" order by id DESC '));
            if ($request->get('uploadStatus') != '') {
                $uploadStatus = $request->get('uploadStatus');
            } else {
                $uploadStatus = '';
            }

            return $this->render('FrontBundle:Upload:index.html.php', array('uploadStatus' => $uploadStatus, 'instruments' => $instruments, 'instrumentFamilies' => $instrumentFamily, 'subscription_details' => $json_user_info, 'info' => $info, 'user_name' => $user_name, 'songs' => $songs, 'advertisement1' => $advertisement1, 'advertisement2' => $advertisement2, 'advertisement3' => $advertisement3, 'advertisement4' => $advertisement4));
        } else {
            return new RedirectResponse($this->generateUrl('_front_login'));
        }
    }

    public function ajaxPublishAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $mData = $request->request->all();
            if (!empty($mData['video_link'])) {
                $videoLink = $mData['video_link'];
            } else {
                $videoLink = '';
            }
            $musicData = json_decode($mData['fileUploadData']);
            $songsPublishData = array(
                'user_id' => $userDetails['login_users_id'],
                'song' => $mData['song'],
                'songs_duration' => $mData['music_duration'],
                'artist' => $mData['artist'],
                'album' => $mData['album'],
                'contributor' => $mData['contributor'],
                'instrument' => $mData['instrument'],
                'instrument_family' => $mData['instrument_family'],
                'video' => $videoLink,
                'hits' => 0,
                'published' => 1,
                'is_deleted' => 1,
                'status' => 1
            );
            if (!empty($musicData)) {
                $prekey = -1;
                foreach ($musicData as $key => $music) {
                    if (($key - $prekey) == 6) {
                        $songsPublishData['music'] = $music;
                    } else {
                        $sheetFileName[$key] = $music;
                    }$prekey = $key;
                }
            }
            $conn->insert('songs', $songsPublishData);

            $songs_last_id = $conn->lastInsertId();
            if (!empty($sheetFileName)) {
                foreach ($sheetFileName as $position => $sheet) {
                    $sheetUpload = array(
                        'songs_id' => $songs_last_id,
                        'music_sheet_name' => $sheet,
                        'position' => $position,
                        'status' => 1,
                        'is_deleted' => 1
                    );
                    $conn->insert('music_sheets', $sheetUpload);
                }
            } else {
                $path = $this->getUploadRootDir() . '/music/';
                if (!empty($sheetFileName)) {
                    foreach ($sheetFileName as $sheet) {
                        unlink($path . $sheet);
                    }
                }
            }

            $songs_info = $conn->fetchAll('SELECT  s.song, s.artist FROM songs s where s.id = ' . $songs_last_id);
            $data_log = array(
                'userid' => $userDetails['login_users_id'],
                'log_date' => date("m/d/Y"),
                'log_time' => time(),
                'details' => "New songs " . $songs_info[0]['song'] . " by " . $songs_info[0]['artist'] . " Published by " . $userDetails['login_users_name'],
                'is_deleted' => 1,
                'status' => 1
            );
        }
        $conn->insert('log_info', $data_log);
        echo 'success';
        exit();
    }

    public function ajaxUploadMusicAction() {
        $data = array();
        if (!empty($_FILES)) {

            $error = false;
            $files = array();
            $uploaddir = $this->getUploadRootDir() . '/music/';
            $prekey = -1;
            //print_r($_FILES);die;
            foreach ($_FILES as $key => $file) {

                if (($key - $prekey) == 6) {
                    $uploaddir = $this->getUploadRootDir() . '/songs/';
                }$prekey = $key;
                if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
                    $files[] = $uploaddir . $file['name'];
                    $fileName[$key] = $file['name'];
                } else {
                    $error = true;
                }
            }
        }
        echo json_encode($fileName);
        exit();
    }

    public function playSongsAction(Request $request) {
        if ($request->get('family') != '' && $request->get('songs_name') != '') {
            $family_id = $request->get('family');
            $songs_name = $request->get('songs_name');
        } else {
            $family_id = '';
            $songs_name = '';
        }
        $conn = $this->get('database_connection');
        $songs_details = $conn->fetchAll('SELECT * FROM songs where published = "1" AND status = "1" AND is_deleted = "1" group by song order by id DESC ');
        foreach ($songs_details as $details) {
            $sound_family[$details['id']] = $conn->fetchAll('SELECT s.id, s.instrument_family, f.name  FROM songs s LEFT JOIN music_family f ON f.id = s.instrument_family where s.song = "' . $details['song'] . '" group by f.name ');
        }
        $advertisement1 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 1 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $advertisement2 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 2 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $advertisement3 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 3 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $advertisement4 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 4 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $category = json_encode($conn->fetchAll('SELECT * FROM music_family where status = "1" AND is_deleted = "1" order by id ASC '));
        $songs = json_encode($songs_details);
        $songs_family = json_encode($sound_family);
        $candateDetails = $this->get('session')->get('users_session');
        if (!empty($candateDetails)) {
            $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');
            $user_info = array();
            if (!empty($subscribed_user_id)) {
                foreach ($subscribed_user_id as $key => $sub_id) {
                    $subid_array[$key] = $sub_id['subscription_user_id'];
                }
                $condition = '';
                if (!empty($subid_array)) {
                    $condition = implode(',', $subid_array);
                }

                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
            }
            $json_user_info = json_encode($user_info);

            return $this->render('FrontBundle:Upload:play_music.html.php', array('songs' => $songs, 'family_id' => $family_id, 'songs_name' => $songs_name, 'subscription_details' => $json_user_info, 'category' => $category, 'songs_family' => $songs_family, 'advertisement1' => $advertisement1, 'advertisement2' => $advertisement2, 'advertisement3' => $advertisement3, 'advertisement4' => $advertisement4));
        } else {
            $user_info = array();
            $json_user_info = json_encode($user_info);
        }

        return $this->render('FrontBundle:Upload:play_music.html.php', array('songs' => $songs, 'family_id' => $family_id, 'songs_name' => $songs_name, 'subscription_details' => $json_user_info, 'category' => $category, 'songs_family' => $songs_family, 'advertisement1' => $advertisement1, 'advertisement2' => $advertisement2, 'advertisement3' => $advertisement3, 'advertisement4' => $advertisement4));
    }

    public function sheetMusicDetailsAction(Request $request, $id) {
        $music_family = $request->get('family');
        $songsName = $request->get('songs');
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        $songs_present_hits = $conn->fetchAll('SELECT  s.* ,ms.music_sheet_name as music_sheet,ms.position FROM songs s LEFT JOIN music_sheets ms ON ms.songs_id = s.id where s.id = "' . $id . '"');
        $update_hits = array(
            'hits' => ($songs_present_hits[0]['hits'] + 1)
        );
        $conn->update('songs', $update_hits, array('id' => $id));
        return $this->render('FrontBundle:Upload:play_music_details.html.php', array('music_family' => $music_family, 'songsName' => $songsName, 'songs' => $songs_present_hits));
    }

    public function playVideoAction(Request $request) {
        $request = $this->getRequest();
        $id = $request->get('id');
        $music_family = $request->get('family');
        $songsName = $request->get('songs');

        $conn = $this->get('database_connection');
        $songs_details = $conn->fetchAll('SELECT * FROM songs where id = "' . $id . '"');
        return $this->render('FrontBundle:Upload:play_video.html.php', array('songs' => $songs_details, 'music_family' => $music_family, 'songsName' => $songsName));
    }

    public function ajaxSearchFamilySoundAction(Request $request) {

        $data = json_decode(file_get_contents('php://input'), true);
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $family = $data["family"];
            $songs = $data["songs"];
            //$songs_family_sounds = $conn->fetchAll('SELECT  s.*, m.name, u.name as username  FROM songs s LEFT JOIN family_sound m ON m.id = s.instrument LEFT JOIN users u ON u.id = s.user_id where s.song = "' . $songs . '" AND s.instrument_family = ' . $family);
            $songs_family_sounds = $conn->fetchAll('SELECT  s.*, m.name, u.name as username,ms.music_sheet_name  FROM songs s LEFT JOIN family_sound m ON m.id = s.instrument LEFT JOIN users u ON u.id = s.user_id LEFT JOIN music_sheets ms ON ms.songs_id = s.id where s.song = "' . $songs . '" AND s.instrument_family = ' . $family . ' GROUP BY s.id ORDER BY m.name');
            echo json_encode($songs_family_sounds);
            //print_r($songs_family_sounds);
            exit();
        }
    }

    public function saveSongsDetailsAction() {
        if ($_POST) {
            $conn = $this->get('database_connection');
            $user_id = $_POST['user_id'];
            $songs_id = $_POST['songs_id'];
            $getSongs = $conn->fetchAll('SELECT * FROM user_saved_songs WHERE user_id ="' . $user_id . '" AND songs_id ="' . $songs_id . '" AND is_deleted = "1"');
            if (!empty($getSongs)) {
                echo 'error';
                exit();
            } else {
                $array = array(
                    'user_id' => $user_id,
                    'songs_id' => $songs_id,
                    'is_deleted' => 1
                );
                $insert = $conn->insert('user_saved_songs', $array);
                echo 'success';
                exit();
            }
        }
    }

    public function savedSongsAction() {
        $candateDetails = $this->get('session')->get('users_session');
        if (!empty($candateDetails)) {
            $conn = $this->get('database_connection');
            $userDetails = $this->get('session')->get('users_session');
            $user_id = $userDetails['login_users_id'];
            $songs = json_encode($conn->fetchAll('SELECT s.*,u.name FROM songs s LEFT JOIN users u ON u.id = ' . $user_id . ' where s.user_id = ' . $user_id . ' AND s.published = "1" AND s.status = "1" AND s.is_deleted = "1" order by s.id DESC '));
            $getSavedSongs_id = $conn->fetchAll('SELECT songs_id FROM user_saved_songs WHERE user_id=' . $user_id);
            $getSongsID = '';
            if (!empty($getSavedSongs_id)) {
                foreach ($getSavedSongs_id as $sid) {
                    $getSongsID.= $sid['songs_id'] . ',';
                    $getSongsfinal = rtrim($getSongsID, ",");
                }
                $songs = json_encode($conn->fetchAll('(SELECT s.*,u.name FROM songs s LEFT JOIN users u ON u.id = ' . $user_id . ' where s.user_id = ' . $user_id . ' AND s.published = "1" AND s.status = "1" AND s.is_deleted = "1" order by s.id DESC ) UNION (SELECT s.*,u.name FROM songs s LEFT JOIN users u ON u.id = s.user_id where  s.id in (' . $getSongsfinal . ')order by s.id DESC )'));
            }

            /* for songs against the users */
            $songsall = json_decode($songs);
            if (!empty($songsall)) {
                foreach ($songsall as $key => $songss) {
                    $songsall[$key]->songs = $conn->fetchAll('SELECT * FROM songs WHERE user_id = ' . $songss->user_id);
                }
            }

            $songs = json_encode($songsall);
            /* for songs against the users */

//            echo '<pre>';
//            print_r($songsall);die;

            $advertisement1 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 1 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement2 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 2 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement3 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 3 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            $advertisement4 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 4 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
            return $this->render('FrontBundle:Upload:saved.html.php', array('songs' => $songs, 'user_id' => $user_id, 'advertisement1' => $advertisement1, 'advertisement2' => $advertisement2, 'advertisement3' => $advertisement3, 'advertisement4' => $advertisement4));
        } else {
            return new RedirectResponse($this->generateUrl('_front_login'));
        }
    }

    public function musicInfoAction(Request $request, $id) {
        $candateDetails = $this->get('session')->get('users_session');
        $conn = $this->get('database_connection');
        if (!empty($candateDetails)) {
            $user_info = array();
            $other_songs = $conn->fetchAll('SELECT s.*,ms.music_sheet_name FROM songs s LEFT JOIN music_sheets ms ON ms.songs_id = s.id WHERE s.id not in (' . $id . ') AND s.status = 1 AND s.is_deleted = 1 ORDER BY RAND() LIMIT 0,4');

            $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');
            if (!empty($subscribed_user_id)) {
                foreach ($subscribed_user_id as $key => $sub_id) {
                    $subid_array[$key] = $sub_id['subscription_user_id'];
                }
                $condition = '';
                if (!empty($subid_array)) {
                    $condition = implode(',', $subid_array);
                }

                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
            }
            $userDetails = $this->get('session')->get('users_session');

            $songs_details = $conn->fetchAll('SELECT  s.*, m.name, u.name as username  FROM songs s LEFT JOIN family_sound m ON m.id = s.instrument LEFT JOIN users u ON u.id = s.user_id where s.id = "' . $id . '"');
            $comment = $conn->fetchAll('SELECT c.comments,u.name FROM comments c LEFT JOIN users u ON u.id = c.logged_user_id LEFT JOIN songs s ON s.id = c.songs_id WHERE c.songs_id = "' . $id . '"');
            return $this->render('FrontBundle:Upload:play_music_info.html.php', array('songs' => $songs_details, 'comments' => $comment, 'subscription_details' => $user_info, 'otherSongs' => $other_songs));
        } else {
            return new RedirectResponse($this->generateUrl('_front_login'));
        }
    }

    public function ajaxMusicSubscribeAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $logged_user_id = $_POST['logged_user_id'];
            $songs_post_user_id = $_POST['songs_post_user_id'];
            $songs_id = $_POST['songs_id'];
            $getSongs = $conn->fetchAll('SELECT * FROM subscribes WHERE login_user_id ="' . $logged_user_id . '" AND subscription_user_id ="' . $songs_post_user_id . '" AND status = "1"');
            if (!empty($getSongs)) {
                echo 'error';
                exit();
            } else {
                $create = array(
                    'login_user_id' => $logged_user_id,
                    'subscription_user_id' => $songs_post_user_id,
                    'status' => '1'
                );
                $conn->insert('subscribes', $create);
                echo 'success';
                exit();
            }
        }
    }

    public function ajaxMusicCommentPostAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $logged_user_id = $_POST['logged_user_id'];
            $comment_text = $_POST['comment_text'];
            $songs_id = $_POST['songs_id'];

            $create = array(
                'comments' => $comment_text,
                'logged_user_id' => $logged_user_id,
                'songs_id' => $songs_id,
                'status' => '1'
            );
            $conn->insert('comments', $create);
            echo 'success';
            exit();
        }
    }

    public function ajaxMusicReportPostAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $logged_user_id = $_POST['logged_user_id'];
            $report_text = $_POST['report_text'];
            $songs_id = $_POST['songs_id'];
            $songsName = $conn->fetchAll('SELECT song FROM songs WHERE id = "' . $songs_id . '"');
            $username = $userDetails['login_users_name'];
            $to = 'shibnis@gmail.com'; //Set Admin Mail Here
            $subject = 'Report against songs  --' . $songsName[0]['song'];
            $message = 'Dear Admin <br><br>';
            $message.='User <b>"' . $username . '"</b> has Report on ' . $songsName[0]['song'] . '<br><br>';
            $message.= $report_text;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers.='From: info@sheetmusic.com' . "\r\n" .
                    'Reply-To: info@sheetmusic.com' . "\r\n";
            mail($to, $subject, $message, $headers);
            //echo $message;
            echo 'success';
            exit();
        }
    }

    function getYoutubeDurationAction() {
        if ($_POST) {
            $vid = $_POST['youtubeid'];
            $videoDetails = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=" . $vid . "&part=contentDetails,statistics&key=AIzaSyDen99uTRRPl9VT_Ra9eAisvZSc4aZDEns");
            $videoDetails = json_decode($videoDetails, true);
            foreach ($videoDetails['items'] as $vidTime) {

                $youtube_time = $vidTime['contentDetails']['duration'];

                preg_match_all('/(\d+)/', $youtube_time, $parts);

                // Put in zeros if we have less than 3 numbers.
                if (count($parts[0]) == 1) {
                    array_unshift($parts[0], "0", "0");
                } elseif (count($parts[0]) == 2) {
                    array_unshift($parts[0], "0");
                }

                $sec_init = $parts[0][2];
                $seconds = $sec_init % 60;
                $seconds_overflow = floor($sec_init / 60);

                $min_init = $parts[0][1] + $seconds_overflow;
                $minutes = ($min_init) % 60;
                $minutes_overflow = floor(($min_init) / 60);

                $hours = $parts[0][0] + $minutes_overflow;

                if ($hours != 0)
                    echo $hours * 60 * 60 + $minutes * 60 + $seconds;
                else
                    echo $minutes * 60 + $seconds;
            }
            exit();
        }
    }

    public function userProfileViewAction($id) {
        $conn = $this->get('database_connection');
        $uploadedSongs = json_encode($conn->fetchAll("SELECT s.*,u.name FROM songs s JOIN users u ON  u.id = s.user_id WHERE s.user_id=" . $id));
        $user_name = $conn->fetchAll("SELECT * FROM users WHERE id=" . $id);

        $candateDetails = $this->get('session')->get('users_session');
        if (!empty($candateDetails)) {
            $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');
            $user_info = array();
            if (!empty($subscribed_user_id)) {
                foreach ($subscribed_user_id as $key => $sub_id) {
                    $subid_array[$key] = $sub_id['subscription_user_id'];
                }
                $condition = '';
                if (!empty($subid_array)) {
                    $condition = implode(',', $subid_array);
                }

                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
            }
            $json_user_info = json_encode($user_info);
            return $this->render('FrontBundle:Upload:userProfileView.html.php', array('uploadedSongs' => $uploadedSongs, 'user_name' => $user_name, 'subscription_details' => $json_user_info));
        } else {
            $json_user_info = array();
            return $this->render('FrontBundle:Upload:userProfileView.html.php', array('uploadedSongs' => $uploadedSongs, 'user_name' => $user_name, 'subscription_details' => $json_user_info));
        }
    }

    public function removeSavedSongsAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {
            $logged_user_id = $userDetails['login_users_id'];
            $songs_id = $_POST['songs_id'];
            $removeSavedSongs = $conn->delete('user_saved_songs', array('user_id' => $logged_user_id, 'songs_id' => $songs_id));
            if (!$removeSavedSongs) {
                $removeSavedSongs = $conn->delete('songs', array('id' => $songs_id, 'user_id' => $logged_user_id));
                $removeSavedSongsOthers = $conn->delete('user_saved_songs', array('songs_id' => $songs_id));
            }
            echo $removeSavedSongs;
            exit();
        }
    }

    public function updateSongsAction(Request $request) {
        $conn = $this->get('database_connection');
        $songsId = $request->get('songs_id');
        $userDetails = $this->get('session')->get('users_session');
        $user_name = $userDetails['login_users_name'];        
        $songDetail = $conn->fetchAll('SELECT s.*,ms.music_sheet_name FROM songs s LEFT JOIN music_sheets ms ON s.id = ms.songs_id WHERE s.id=' . $songsId);        
        $advertisement1 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 1 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $advertisement2 = $conn->fetchAll('SELECT advertisements FROM advertisements where advetisements_type = 2 AND status = "1" AND is_deleted = "1" ORDER BY RAND() limit 0,1 ');
        $songs = json_encode($conn->fetchAll('SELECT * FROM songs where user_id = ' . $userDetails['login_users_id'] . ' AND published = "1" AND status = "1" AND is_deleted = "1" order by id DESC '));
        
        $instrumentFamily = json_encode($conn->fetchAll('SELECT * FROM music_family WHERE status = 1 AND is_deleted = 1'));
        $instruments = json_encode($conn->fetchAll('SELECT * FROM family_sound WHERE status = 1 AND is_deleted = 1'));
       
        
//         $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');
//            
//            $user_info = array();
//            if (!empty($subscribed_user_id)) {
//                foreach ($subscribed_user_id as $key => $sub_id) {
//                    $subid_array[$key] = $sub_id['subscription_user_id'];
//                }
//                $condition = '';
//                if (!empty($subid_array)) {
//                    $condition = implode(',', $subid_array);
//                }
//
//                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
//            }
//            $json_user_info = json_encode($user_info);
        
        return $this->render('FrontBundle:Upload:updateSongs.html.php', array('user_name' => $user_name,'advertisement1' => $advertisement1, 'instruments' => $instruments, 'instrumentFamilies' => $instrumentFamily,  '$advertisement2' => $advertisement2, 'songDetail' => $songDetail, 'songs' => $songs,'songsId'=>$songsId));
    }
    
    
    public function ajaxUpdateSongsAction(Request $request) {
        $conn = $this->get('database_connection');
        $userDetails = $this->get('session')->get('users_session');
        if ($request->getMethod() == "POST") {            
            $mData = $request->request->all();
            $songsID = $mData['songsId'];
            if (!empty($mData['video_link'])) {
                $videoLink = $mData['video_link'];
            } else {
                $videoLink = '';
            }
            $musicData = json_decode($mData['fileUploadData']);
            $songsPublishData = array(
                'user_id' => $userDetails['login_users_id'],
                'song' => $mData['song'],
                'songs_duration' => $mData['music_duration'],
                'artist' => $mData['artist'],
                'album' => $mData['album'],
                'contributor' => $mData['contributor'],
                'instrument' => $mData['instrument'],
                'instrument_family' => $mData['instrument_family'],
                'video' => $videoLink,
                'hits' => 0,
                'published' => 1,
                'is_deleted' => 1,
                'status' => 1
            );
            if (!empty($musicData)) {
                $prekey = -1;
                foreach ($musicData as $key => $music) {
                    if (($key - $prekey) == 6) {
                        $songsPublishData['music'] = $music;
                    } else {
                        $sheetFileName[$key] = $music;
                    }$prekey = $key;
                }
            }
            $conn->update('songs', $songsPublishData,array('id'=>$songsID));

            $songs_last_id = $songsID;
            if (!empty($sheetFileName)) {
                foreach ($sheetFileName as $position => $sheet) {
                    $sheetUpload = array(
                        'songs_id' => $songs_last_id,
                        'music_sheet_name' => $sheet,
                        'position' => $position,
                        'status' => 1,
                        'is_deleted' => 1
                    );
                    $conn->delete('music_sheets',array('songs_id'=>$songsID));
                    $conn->insert('music_sheets', $sheetUpload);
                }
            } else {
                $path = $this->getUploadRootDir() . '/music/';
                if (!empty($sheetFileName)) {
                    foreach ($sheetFileName as $sheet) {
                        unlink($path . $sheet);
                    }
                }
            }

            $songs_info = $conn->fetchAll('SELECT  s.song, s.artist FROM songs s where s.id = ' . $songs_last_id);
            $data_log = array(
                'userid' => $userDetails['login_users_id'],
                'log_date' => date("m/d/Y"),
                'log_time' => time(),
                'details' => "New songs " . $songs_info[0]['song'] . " by " . $songs_info[0]['artist'] . " Published by " . $userDetails['login_users_name'],
                'is_deleted' => 1,
                'status' => 1
            );
        }
        $conn->insert('log_info', $data_log);
        echo 'success';
        exit();
    }
    
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

}
