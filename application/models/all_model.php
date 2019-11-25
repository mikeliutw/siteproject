<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_model extends CI_Model {

    var $schedule;
    var $time;

    function __construct() {

        // 呼叫模型(Model)的建構函數
        parent::__construct();
    }

    function getPath() {
        $url = base_url() . "/application/views/admin/";
        $adminurl = base_url() . "index.php/admin/";

        return array($url, $adminurl);
    }

    function getPathIndex() {
        $url = base_url() . "";
        $adminurl = base_url() . "index.php/";

        return array($url, $adminurl);
    }

    function getTime() {

        date_default_timezone_set("Asia/Taipei");
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();

        return mdate($datestring, $time);
    }

    function getYear() {

        date_default_timezone_set("Asia/Taipei");
        $datestring = "%Y";
        $time = time();

        return mdate($datestring, $time);
    }

    function getDate() {

        date_default_timezone_set("Asia/Taipei");
        $datestring = "%Y-%m-%d";
        $time = time();

        return mdate($datestring, $time);
    }

    function updatemail() {


        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'optoicus@gmail.com';
        $password = 'Hgwebsite4u';

        /*

          $hostname = '{imap.ipage.com:993/imap/ssl}INBOX';
          $username = 'james.yeh@optixcom.com';

          $password = 'pingtung';
         */
        /* try to connect */
        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox, 'ALL');

        /* if emails are returned, cycle through each... */
        if ($emails) {

            /* begin output var */
            $output = '';

            /* put the newest emails on top */
            rsort($emails);

            /* for every email... */
            foreach ($emails as $email_number) {

                /* get information specific to this email */
                $overview = imap_fetch_overview($inbox, $email_number, 0);
                $message = imap_fetchbody($inbox, $email_number, 1);

                /* output the email header information */
                $subject = imap_utf8($overview[0]->subject);


                $output.= '<div class="toggler ' . ($overview[0]->seen ? 'read' : 'unread') . '">';
                $output.= '<span class="subject">' . $subject . '</span> ';
                $output.= '<span class="from">' . imap_utf8($overview[0]->from) . '</span>';
                $output.= '<span class="date">on ' . $overview[0]->date . '</span>';
                $output.= '</div>';

                $orgmessage = $message;

                if (base64_decode($message)) {

                    $message = base64_decode($message);
                    $encode = mb_detect_encoding($message, "ASCII,UTF-8,GB2312,GBK,BIG5");

                    switch ($encode) {
                        case "ASCII":
                        case "UTF-8":
                        case "GB2312":
                        case "BIG5":
                            break;
                        default :
                            $message = $orgmessage;

                            break;
                    }
                }

                $ticket = strpos($subject, "[optixcom #");
                // echo $ticket;

                $ticket = substr($subject, $ticket + 15, 6);
                //    echo $ticket;


                $ticket = str_replace("0", "", $ticket);
                // echo $ticket;

                if ($ticket != ""):

                    $sql = "select * from inquiry where id='$ticket'";
                    //   echo $sql;
                    $query = $this->db->query($sql);

                    if ($query->num_rows() > 0) {


                        //     echo $ticket;

                        $inqid = $query->row()->id;

                        $header = imap_headerinfo($inbox, $email_number);
                        $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                        if (str_word_count($message) > 200):
                            $message = substr($message, 0, 200);
                        endif;
                        $message = str_replace('"', "'", $message);
                        $sql = "select * from reply where inqid='" . $inqid . "' and fromw ='" . $fromaddr . "' and reply like \"%" . $message . "%\"";
//echo $sql;
                        $query = $this->db->query($sql);

                        if ($query->num_rows() == 0) {

                            $this->db->query("insert into reply value  ('','" . $inqid . "',\"" . $message . "\",NOW(),'" . $fromaddr . "')");
                        }
                    }

                endif;


                $output.= '<div class="body">' . $message . '</div>';
            }

            // echo $output;
        }

        /* close the connection */
        imap_close($inbox);


    }

}
