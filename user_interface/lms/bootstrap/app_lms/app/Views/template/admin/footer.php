</div>
        </div>
        
    </div>
    <footer>
        <div class="content">
            Copyright - NDEVS
        </div>
    </footer>
</div>
    <script>
        
        // var surat = document.getElementById('surat')
        // var ujian = document.getElementById('ujian')
        // var siswa = document.getElementById('siswa')
        function surat(){
            var surat = document.getElementById('surat');
            var ujian = document.getElementById('ujian')
            var siswa = document.getElementById('siswa')
            var jadwal = document.getElementById('jadwal')
            surat.classList.add('active');
            ujian.classList.remove('active')
            siswa.classList.remove('active')
            jadwal.classList.remove('active')
        }
        function ujian(){
            var surat = document.getElementById('surat');
            var ujian = document.getElementById('ujian')
            var siswa = document.getElementById('siswa')
            var jadwal = document.getElementById('jadwal')
            ujian.classList.add('active');
            surat.classList.remove('active')
            siswa.classList.remove('active')
            jadwal.classList.remove('active')
        }
        function jadwal(){
            var surat = document.getElementById('surat');
            var ujian = document.getElementById('ujian')
            var siswa = document.getElementById('siswa')
            var jadwal = document.getElementById('jadwal')
            jadwal.classList.add('active');
            surat.classList.remove('active')
            siswa.classList.remove('active')
            ujian.classList.remove('active')
        }
        function siswa(){
            var surat = document.getElementById('surat');
            var ujian = document.getElementById('ujian')
            var siswa = document.getElementById('siswa')
            var jadwal = document.getElementById('jadwal')
            siswa.classList.add('active');
            ujian.classList.remove('active')
            surat.classList.remove('active')
            jadwal.classList.remove('active')
        }
    </script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
  </body>
</html>
