<script>
    function confFunctions(){
        checkConfiguration();
       
    }

    function nodecpustats(){

        var form = new FormData();
        request(API('nodecpustats'), form, function(response) {

            data = JSON.parse(response).message;
            $("#nodecpustats").css("font-size", "15px");
            $("#nodecpustats").text(data);
            
        }, function(response) {
                let error = JSON.parse(response);
                showSwal(error.message, 'error', 3000);
        });
    }

    function nodememstats(){

        var form = new FormData();
        request(API('nodememstats'), form, function(response) {

            data = JSON.parse(response).message;
            $("#nodememstats").css("font-size", "15px");
            $("#nodememstats").text(data);
            
        }, function(response) {
                let error = JSON.parse(response);
                showSwal(error.message, 'error', 3000);
        });
    }

    function nodeInfo(){

            var form = new FormData();
            request(API('node_info'), form, function(response) {

                data = JSON.parse(response).message;
                $("#nodeInfo").css("font-size", "15px");
                $("#nodeInfo").text(data);
                
            }, function(response) {
                        let error = JSON.parse(response);
                        showSwal(error.message, 'error', 3000);
            });
    }

    function diskInfo(){

        var form = new FormData();
            request(API('disk_info'), form, function(response) {

                data = JSON.parse(response).message;
                $("#diskInfo").css("font-size", "15px");
                $("#diskInfo").text(data);
                
            }, function(response) {
                        let error = JSON.parse(response);
                        showSwal(error.message, 'error', 3000);
            });
    }


    function checkConfiguration(){
        
        var form = new FormData();

        request(API('check_configuration'), form, function(response) {

            data = JSON.parse(response)["message"];
            if(data == "create"){ 
                $(".gizli").css("display", "none");  
                $("#confAlert").addClass("alert-danger");
                $("#confAlert").html("Konfigürasyon dosyasını oluşturmak için formu doldurunuz!");
            }
            else {   
                $(".gizli").css("display", "block"); 
                $("#confAlert").removeClass("alert-danger");
                $("#confAlert").addClass("alert-success");        
                $("#confAlert").html("Konfigürasyon dosyasının içeriğini aşağıdan görebilir ve güncelleyebilirsiniz.");
               
                $('#ldaphost').val(data[0]);
                $('#ldapbasedn').val(data[1]);
                $('#ldapusername').val(data[2]);
                $('#ldappassword').val(data[3]);
                $('#hostip').val(data[4]);

                nodeInfo();
                diskInfo();
                nodecpustats();
                nodememstats();

            }
        }, function(response) {
            let error = JSON.parse(response);
            showSwal(error.message, 'error', 3000);
        });
        
    }

    function updateConf(){

        let send = true;
        $("#conf-form").find('input').each(function(index, element){
            if ($(this).val() == "") 
                send = false;
            })

        if(send){
            var form = new FormData();
            form.append("ldaphost",$('#ldaphost').val());
            form.append("ldapbasedn",$('#ldapbasedn').val());
            form.append("ldapusername",$('#ldapusername').val());  
            form.append("ldappassword",$('#ldappassword').val());
            form.append("hostip",$('#hostip').val());

            request(API('update_configuration_file'), form, function(response) {
                //ldapCheck();
                checkConfiguration();
                showSwal("Konfigürasyon Dosyası Güncellendi", 'success', 3000);
                $(".gizli").css("display", "block"); 
                }, function(response) {
                    let error = JSON.parse(response);
                    showSwal(error.message, 'error', 3000);
            });
        }
        else{
            $(".gizli").css("display", "none");  
            showSwal("Lütfen Boş Alanları Doldurunuz!", 'error', 2000);
            return;
        }
  
    }

    function checkLdap(){
        var form = new FormData();
        request(API('check_ldap'), form, function(response) {
            message = JSON.parse(response)["message"];
            showSwal(message, 'success', 3000);
            
        }, function(response) {
                let error = JSON.parse(response);
                showSwal(error.message, 'error', 3000);
        });
    }



</script>
