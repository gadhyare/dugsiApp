 
 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script>
<script src="{{asset('js/datatables.js')}}"></script>

@livewireScripts
<script>


    document.addEventListener('hide-moda', event => {
        $(".xidh").modal("hide");
    })


   
 


 </script>
   @include('admin.layouts.sweetaler')



</body>

</html>
