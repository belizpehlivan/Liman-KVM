<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
    <li class="nav-item">
        <a class="nav-link active" onclick="checkConfiguration()" href="#configuration" data-toggle="tab">   <!--aria-controls="v-pills-updates" aria-selected="false"-->
            <i class="fas fa-tasks"></i> {{ __("Konfigürasyon") }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="getVM()" href="#vms" data-toggle="tab">
            <i class="fas fa-tasks"></i> {{ __("Sanal Makineler") }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="listVdi()" href="#vdi" data-toggle="tab">
            <i class="fas fa-desktop"></i> {{ __("VDI") }}
        </a>
    </li>
</ul>

<div class="tab-content">
    <div id="configuration" class="tab-pane active">
        @include('configuration.main')
    </div>
    <div id="vms" class="tab-pane tabItem">
        @include('vms.main')
    </div>
    <div id="vdi" class="tab-pane tabItem">
        
        @include('vdi.main')
    </div>
</div>

<script>
    if (location.hash ==="") {
        checkConfiguration();
    }

    $(document).ready(function(){
        var check = checkConf();
        return check;
    });

    function checkConf(){

        var form = new FormData();

        request(API('check_conf'), form, function(response) {
            response = JSON.parse(response)["message"];
            if(response == "true")
                $(".tabItem").css("visibility", "visible");
            else
                $(".tabItem").css("visibility", "hidden");  
            }, function(response) {
                    let error = JSON.parse(response);
                    showSwal(error.message, 'error', 3000);
        });
    }
</script>
