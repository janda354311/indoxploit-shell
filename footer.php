<?php
//no DIRECT ACCESS
if ($anton!="hilman") exit('<h2>No Direct Access</h2><a href="'.$URL.'">home</a>');
?>

</section>
        
        <aside>

			<?php
			if($_POST['q']!='') { //SEARCHING
				$kata = trim($_POST['q']);
				//echo 'kata='.$kata;
				//logcari($kata);
				$special_chars = array("?", ".", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
				$kata = str_replace($special_chars, '', $kata);
				$kata = preg_replace('/[\s-]+/', '+', $kata);
				// mencegah XSS
				$kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
				header( 'Location: '.$URL.'/cari/'.$kata );
			}
			?>
            <div class="cari">
            <form method="post" action="?">
              <input type="text" name="q" placeholder="Cari.." autocomplete="off">
            </form>
            </div>
            <!--
            <div id="clockdiv">
                <div>
                	<span class="days"></span>
                	<div class="smalltext">Hari</div>
                </div>
                <div>
                	<span class="hours"></span>
                	<div class="smalltext">Jam</div>
                </div>
                <div>
                	<span class="minutes"></span>
                	<div class="smalltext">Menit</div>
                </div>
                <div>
                	<span class="seconds"></span>
                	<div class="smalltext">Detik</div>
                </div>
            </div>
            <script>
			function getTimeRemaining(endtime) {
			  const total = Date.parse(endtime) - Date.parse(new Date());
			  const seconds = Math.floor((total / 1000) % 60);
			  const minutes = Math.floor((total / 1000 / 60) % 60);
			  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
			  const days = Math.floor(total / (1000 * 60 * 60 * 24));
			  
			  return {
				total,
				days,
				hours,
				minutes,
				seconds
			  };
			}
			
			function initializeClock(id, endtime) {
			  const clock = document.getElementById(id);
			  const daysSpan = clock.querySelector('.days');
			  const hoursSpan = clock.querySelector('.hours');
			  const minutesSpan = clock.querySelector('.minutes');
			  const secondsSpan = clock.querySelector('.seconds');
			
			  function updateClock() {
				const t = getTimeRemaining(endtime);
			
				daysSpan.innerHTML = t.days;
				hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
				minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
				secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
			
				if (t.total <= 0) {
				  clearInterval(timeinterval);
				}
			  }
			
			  updateClock();
			  const timeinterval = setInterval(updateClock, 1000);
			}
			
			const deadline = 'December 9 2020';
			initializeClock('clockdiv', deadline);
			</script>
            -->
            
            <div id="kalender" class="calendar-container"></div>
            <script>
			  $(document).ready(function () {
				$("#kalender").simpleCalendar({
				  fixedStartDay: false,
				  disableEmptyDetails: true,
				  
				  	months: ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'],
					days: ['ahad','senin','selasa','rabu','kamis','jumat','sabtu'],
					displayYear: true,              // Display year in header
					fixedStartDay: true,            // Week begin always by monday
					displayEvent: true,             // Display existing event
					disableEventDetails: false, // disable showing event details
					disableEmptyDetails: true, // disable showing empty date details
					events: [],                     // List of events
					onInit: function (calendar) {}, // Callback after first initialization
					onMonthChange: function (month, year) {}, // Callback on month change
					onDateSelect: function (date, events) {}, // Callback on date selection
					onEventSelect: function() {}, // Callback on event selection - use $(this).data('event') to access the event
					onEventCreate: function( $el ) {},          // Callback fired when an HTML event is created - see $(this).data('event')
					onDayCreate:   function( $el, d, m, y ) {},  // Callback fired when an HTML day is created   - see $(this).data('today'), .data('todayEvents')
				  
				  events: [
					<?php //ambil data
					$bln_ini= date("Y-m-01");
					$query	= mysqli_query($koneksi, "SELECT judul,mulai,selesai FROM tb_agenda WHERE aktif='1' AND mulai >= '".$bln_ini."' ORDER BY id");
					$jum	= mysqli_num_rows($query);
					$i		= 0;
					while( $row = mysqli_fetch_array($query) ){	
					$i++;
					?>					
					{
					  startDate: new Date("<?php echo $row['mulai'];?>").toDateString(),
					  endDate: new Date("<?php echo $row['selesai'];?>").toDateString(),
					  summary: '<?php echo htmlspecialchars($row['judul'], ENT_QUOTES); ?>'
					}
					<?php
					if($jum!=$i) echo ',';
					} //end ambil data
					mysqli_free_result($query); //bebaskan memori
					?>

				  ],
			
				});
			  });
			</script>            
                        
            <?php tulis_banner(4);?>
            
        </aside>
        
        <div class="clearfix"></div>
        
    </div>
</div>

<footer id="footer">
    <div id="footer_atas">
    	<div class="kolom4">
        	<h4><i class="fa fa-building-o"></i> TENTANG PARTAI DEMOKRAT</h4>
            <ul class="list_footer">
                <?php //ambil data
				$query	= mysqli_query($koneksi, "SELECT id,judul FROM tb_profil WHERE aktif='1' ORDER BY id");
				while( $row = mysqli_fetch_array($query) ){	
				?>
				<li><a href="<?php SEF_det("profil",$row['id'], $row['judul']); ?>"><?php echo $row['judul'];?></a></li>
				<?php
				} //end ambil data
				mysqli_free_result($query); //bebaskan memori
				?>                
                <li><a href="<?php SEF_mod("komisioner"); ?>">Anggota DPD</a></li>
                <li><a href="<?php SEF_mod("sekretariat"); ?>">Anggota DPC</a></li>
            </ul>
        </div>
        <div class="kolom4">
        	<h4><i class="fa fa-book"></i> KONTAK PARTAI DEMOKRAT</h4>
            <ul class="list_footer">
                <li><a href="<?php SEF_mod("kontak"); ?>">Kontak Kami</a></li>
                <li><a href="<?php SEF_mod("pengaduan"); ?>">Kotak Pengaduan</a></li>
                <li><i class="fa fa-facebook"></i> <a href="https://www.facebook.com/<?php echo $DT_FB;?>" target="_blank">Facebook</a></li>
                <li><i class="fa fa-twitter"></i> <a href="https://www.twitter.com/<?php echo $DT_TW;?>" target="_blank">Twitter</a></li>
                <li><i class="fa fa-instagram"></i> <a href="https://www.instagram.com/<?php echo $DT_IG;?>" target="_blank">Instagram</a></li>
                <li><i class="fa fa-youtube"></i> <a href="https://www.youtube.com/<?php echo $DT_YT;?>" target="_blank">YouTube</a></li>                                
            </ul>
        </div>
        <div class="kolom4">
        	<h4><i class="fa fa-info-circle"></i> INFO PARTAI DEMOKRAT</h4>
            <ul class="list_footer">
                <li><a href="<?php SEF_mod("berita"); ?>">Berita Terbaru</a></li>
                <li><a href="<?php SEF_mod("berita"); ?>">Artikel &amp; Tulisan</a></li>
                <li><a href="<?php SEF_mod("berita"); ?>">Pengumuman</a></li>
                <li><a href="<?php SEF_mod("berita"); ?>">Agenda Kegiatan</a></li>
            </ul>
        </div>
        <div class="kolom4">
        	<h4><i class="fa fa-ellipsis-h"></i> LAINNYA</h4>
            <ul class="list_footer">                
                <li><a href="<?php SEF_mod("file"); ?>">Download</a></li>
                <li><a href="<?php SEF_mod("foto"); ?>">Galeri Foto</a></li>
                <li><a href="<?php SEF_mod("video"); ?>">Video</a></li>
                <li><a href="<?php SEF_mod("sitemap"); ?>">Peta Situs</a></li>
                <li><a href="<?php SEF_mod("links"); ?>">Link</a></li>
                <li><a href="<?php SEF_mod("cari"); ?>">Cari</a></li>
                <li><a href="<?php SEF_mod("indeks"); ?>">Indeks</a></li>
                <li><a href="<?php SEF_mod("tag"); ?>">Tag</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="footer_bawah">
    	<p class="footer_bawah">Copyright &copy; <?php echo date("Y"); ?> <strong><span class="vcard"><a class="url fn org" href="<?php echo $URL; ?>"><?php echo $DT_NAMAP;?></a></span></strong>. All rights reserved.</p>        
    </div>
</footer>
<?php if($mod=='foto' OR $mod=='cari' OR $mod=='tag' OR $mod=='indeks') {?>
<!--lightbox-->
<script src="<?php echo $URL; ?>/lightbox/js/lightbox.js"></script>
<!--/lighbox-->
<?php } ?>

<!--fb-->
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--/fb-->

<!--lazyload-->

<!--/lazyload-->

</body>
</html>


<?php //STATISTIK
$tip	= $_SESSION['ip'];
$tjam	= $_SESSION['jam'];
$ttgl	= $_SESSION['tgl'];

$t_file	= $_SERVER['REQUEST_URI'];
if ($HTTP_X_FORWARDED_FOR) {
	$t_ip	= $HTTP_X_FORWARDED_FOR;
	$t_host	= $HTTP_VIA;
} else {
	$t_ip	= $_SERVER['REMOTE_ADDR'];
	$t_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
}

if($tip=='' && $tjam=='' && $ttgl==''){ 
	$jam	= date("H:i:s");
	$tgl	= date("Y-m-d");		
	$_SESSION["ip"]		= $t_ip;
	$_SESSION["jam"]	= $jam;
	$_SESSION["tgl"]	= $tgl;
}

$sip	= $_SESSION['ip'];
$sjam	= $_SESSION['jam'];
$stgl	= $_SESSION['tgl'];
//
$query	= mysqli_query($koneksi,"SELECT id FROM tb_stat WHERE ip='$sip' AND tgl='$stgl' AND waktu='$sjam'");
$row	= mysqli_num_rows($query);
mysqli_free_result($query); //bebaskan memori

if($row==0){
	mysqli_query($koneksi,"INSERT INTO tb_stat VALUES (NULL,'$sip','$stgl','$sjam','$t_host','$t_file')");	
}

//HIT
mysqli_query($koneksi,"UPDATE tb_hit SET hit = hit+1");
//ONLINE USER
$t_secs	= 120;
$t_stamp= time(); 
$t_time	= $t_stamp - $t_secs; 

mysqli_query($koneksi,"INSERT INTO tb_online (`tipe`, `username`, `session`, `time`, `ip`, `proxy_host`, `file`) VALUES ('5', 'guest', '', '$t_time', '$t_ip', '$t_host', '$t_file')");
mysqli_query($koneksi,"DELETE FROM tb_online WHERE time<$t_time");
?>
