<?php



if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

function seoaddon_config() {
    $configarray = array(
        "name" => "TMS SEO ADDON",
        "description" => "Temasbilisim.com ücretsiz SEO eklenti modülü. Sayfa başlığı, Açıklama & Anahtar Kelimeler.",
        "version" => "1.0",
        "author" => "temasbilisim.com",
        "language" => "turkish",
    );
    return $configarray;
}

function seoaddon_upgrade($vars) {
    //Upgrade
}

function seoaddon_activate() {
    $query = "CREATE TABLE `mod_seoaddon` (`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`pageurl` TEXT NOT NULL ,`pageheader` TEXT NOT NULL,`keyword` TEXT NOT NULL,`description` TEXT NOT NULL,`ogurl` TEXT NOT NULL,`ogtype` TEXT NOT NULL,`ogtitle` TEXT NOT NULL,`ogimage` TEXT NOT NULL,`ogdesc` TEXT NOT NULL)";
    $result = full_query($query);
    return array('status' => 'success', 'description' => 'Temas Bilişim SEO eklentisi basarili bir sekilde aktif edildi :) ');
}

function seoaddon_deactivate() {
    $query = "DROP TABLE `mod_seoaddon`";
    $result = full_query($query);
    return array('status' => 'success', 'description' => 'Temas Bilişim SEO eklentisi basarili bir sekilde pasif hale getirildi :( ');
}

function seoaddon_output($vars) {
    if (isset($_REQUEST['deleteseo'])) {
        $id = $_REQUEST['deleteseo'];
        $query = "Delete from mod_seoaddon where id='$id';";
        mysql_query($query);
        echo "<div class='alert alert-info'>SEO Sayfası Başarıyla Silindi</div>";
    } else if (isset($_REQUEST['editseo'])) {
        $id = $_REQUEST['editseo'];
        $sql = "SELECT * FROM mod_seoaddon where id='$id'";
        $result = mysql_query($sql);
        while ($data = mysql_fetch_array($result)) {
            $id = $data['id'];
            $pageurl = $data['pageurl'];
            $keyword = $data['keyword'];
            $description = $data['description'];
            $pageheader = $data['pageheader'];
            $ogurl = $data['ogurl'];
            $ogtype = $data['ogtype'];
            $ogtitle = $data['ogtitle'];
            $ogimage = $data['ogimage'];
            $ogdesc = $data['ogdesc'];
        }
    }
    if (isset($_POST['pageurl'])) {
        $pageurl = $_POST['pageurl'];
        if (!empty($pageurl) && $pageurl != "") {
            $keyword = stripslashes($_POST['keyword']);
            $description = stripslashes($_POST['description']);
            $pageheader = stripslashes($_POST['pageheader']);
            $ogurl = stripslashes($_POST['ogurl']);
            $ogtype = stripslashes($_POST['ogtype']);
            $ogtitle = stripslashes($_POST['ogtitle']);
            $ogimage = stripslashes($_POST['ogimage']);
            $ogdesc = stripslashes($_POST['ogdesc']);
            $id = $_POST['id'];
            if ($id == "") {
                $query = "INSERT INTO mod_seoaddon (`pageurl`, `pageheader`, `keyword`,`description`, `ogurl`, `ogtype`, `ogtitle`, `ogimage`, `ogdesc`) VALUES ('$pageurl', '$pageheader', '$keyword', '$description', '$ogurl', '$ogtype', '$ogtitle', '$ogimage', '$ogdesc' )";
                echo "<div class='alert alert-success'>Seo Sayfası Eklendi</div>";
            } else {
                $query = "update mod_seoaddon set `pageurl`='$pageurl', `pageheader`='$pageheader', `keyword`='$keyword', `description`='$description', `ogurl`='$ogurl', `ogtype`='$ogtype', `ogtitle`='$ogtitle', `ogimage`='$ogimage', `ogdesc`='$ogdesc' where id='$id'";
                echo "<div class='alert alert-success'>SEO Sayfası Güncellendi</div>";
            }
            mysql_query($query);
        } else if (isset($pageurl)) {
            echo "<div class='alert alert-danger'>Lütfen Sayfa URL'sini ve Diğer Ayrıntıları girin</div>";
        }
        $pageurl = "";
        $pageheader = "";
        $keyword = "";
        $description = "";
        $id = "";
        $ogurl = "";
        $ogtype = "";
        $ogtitle = "";
        $ogimage = "";
        $ogdesc = "";
    }
    echo '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

<ul class="nav nav-tabs" id="myTab">
   <li class="active"><a data-toggle="tab" href="#home">Yeni Oluştur</a></li>
   <li><a data-toggle="tab" href="#menu1">SEO Kayıtları</a></li>
</ul>
<div class="tab-content" style="padding-top:10px;">
    <div id="home" class="tab-pane fade in active"> 
        <form class="form-horizontal " action="" method="post" id="JqSeoForm">
            <input type="hidden" name="action" value="save" />
              <input type="hidden" name="id" value="' . $id . '">
                    <div class="col-lg-5 ccc">
                        <div class="form-group fg1">
                            <label class="col-lg-3 control-label cont-label" for="inputMode">SEO YAPILACAK URL</label>
                                <div class="col-lg-9 ">
                                    <input type="text" class="form-control form-cl1" placeholder="WHMCS Sayfa URL : ornek.php" name="pageurl" value="' . $pageurl . '">
                                      </div>
                                </div>
                        <div class="form-group fg2">
                            <label class="col-lg-3 control-label cont-label" for="inputMode">Title</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Meta başlık etiketinizi giriniz." name="pageheader"  value="' . $pageheader . '">              
                                       </div>
                                </div>  
                        <div class="form-group fg3">
                            <label class="col-lg-3 control-label cont-label" for="inputMode">Keyword</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="keyword" placeholder="Anahtar kelimelerinizi buraya giriniz." value="' . $keyword . '" >
                               </div>
                         </div>
                        <div class="form-group fg4">
                            <label class="col-lg-3 control-label cont-label" for="inputMode">Description</label>
                                <div class="col-lg-9">
                                    <textarea cols="15"  rows="3" class="form-control" placeholder="Site açıklamasını buraya giriniz." name="description">' . $description . '</textarea>
                               </div>
                         </div>
                   </div>
                    <div class="col-lg-6 divcl">
					    <p class="text-center wall wall-sm">
							Açık Grafik Paylaşımı / Facebook paylaşımı hakkında daha fazla bilgi için, lütfen <a href="https://developers.facebook.com/docs/sharing/webmasters">buraya</a> bakın.
						</p>
                        <div class="form-group ">
                            <label class="col-lg-3 control-label cont-label" for="inputMode">OG URL</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Facebook paylaşım adresinizi girin." name="ogurl" value="' . $ogurl . '">
                              </div>
                         </div>
                    <div class="form-group fg5">
                        <label class="col-lg-3 control-label cont-label" for="inputMode">OG:Type</label>
                            <div class="col-lg-9">
                               <input type="text" class="form-control" placeholder="Facebook paylaşım tipinizi girin." name="ogtype"  value="' . $ogtype . '"> 
                                  </div>
                            </div>
                    <div class="form-group fg6">
                        <label class="col-lg-3 control-label cont-label" for="inputMode">OG:Title</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Facebook paylaşım başlığını girin." name="ogtitle" value="' . $ogtitle . '"> 
                                    </div>
                              </div>
                    <div class="form-group fg7">
                        <label class="col-lg-3 control-label cont-label" for="inputMode">OG:Image</label>
                            <div class="col-lg-9">
                                <textarea cols="15" rows="3" class="form-control" placeholder="Facebook paylaşım resminizi girin." name="ogimage">' . $ogimage . '</textarea>
                           </div>
                      </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label cont-label" for="inputMode">OG:Description</label>
                            <div class="col-lg-9">
                                <textarea cols="15" rows="2" class="form-control" placeholder="Facebook paylaşım açıklamasını girin." name="ogdesc">' . $ogdesc . '</textarea>
                           </div>
                     </div>
              </div> 
                    <div class="col-lg-10 klm">
                         <p align="center"><input type="submit" id="seosave" name="seosave" value="Save" class="btn btn-submit"/> <br> <br> <a href="https://www.TemasBilisim.com/" target="_blank">Powered by www.TemasBilisim.com</a></p>                                
</div>     
      </form>     
            </div>
                    <div id="menu1" class="tab-pane fade">
                    <div class="col-lg-12">
                    <table width="100%" id="example-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="tblhd1">Numara</th>
                                <th class="tblhd2">URL</th>
                                    <th class="tblhd3">Başlık</th>
                                        <th class="tblhd4">İşlem</th>
                                            </tr>
                                                </thead>
                                                    <tbody>
';
    /* Getting messages order by date desc */
    $sql = "SELECT pageurl,pageheader,id FROM mod_seoaddon order by id";
    $result = mysql_query($sql);
    while ($data = mysql_fetch_array($result)) {
        $sam[] = $data;
    }
    foreach ($sam as $key => $val) {
        $p = $key + 1;
        echo '<tr class="tblrow">';
        echo '<td class="tblcol" style="width:5%">' . $p . '</td>';
        echo '<td>' . $url = $val['pageurl'] . '</td>';
        echo '<td>' . $head = $val['pageheader'] . '</td>';
        echo '<td style="width:10%"><a href="addonmodules.php?module=seoaddon&editseo=' . $val['id'] . '" title="düzenle">'
        . '<span class="glyphicon glyphicon-edit text-info"></a>'
        . '&nbsp;<a href="addonmodules.php?module=seoaddon&deleteseo=' . $val['id'] . '" title="sil">'
        . '<span class="glyphicon glyphicon-trash text-danger"></a> </td></tr>';
    }
    echo '</tbody> </table>';
    echo '</div></div></div>';
    echo '<script type="text/javascript">
    $(document).ready(function()
    {
        $("#example-table").dataTable();
        $("#example-table_wrapper .row:last-child").children("div").removeClass("col-sm-6").addClass("col-sm-4");
        $("#example-table_wrapper .row:last-child").children(".col-sm-4:eq(1)").before(\'<div class="col-sm-4"><p style="padding-top:10px;" class="text-center text-info"><a href="https://www.TemasBilisim.com/" target="_blank">Powered by www.TemasBilisim.com</a></p></div>\');        
})
</script>';
    echo '<script type="text/javascript">
$(document).ready(function()
{
$("#errorbox").delay(1000).fadeOut();
$("#successbox").delay(1000).fadeOut();
$("#updatebox").delay(1000).fadeOut();
});
</script>';
}
