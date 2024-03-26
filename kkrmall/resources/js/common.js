function select_option(){
    var product_no = $("#product_no").val();
    var option_no = $("#option_no").val();

    var formData = new FormData(file);
    formData.append('product_no', product_no);
    formData.append('option_no', option_no);

    if(product_no=='' || option_no==''){
        console.log("빈값있음!");
        return false;
    }
    console.log("ㅇㄹㄴㅇㄹㄴㅇㄹㄴㅇ");

    $.ajax({
        //아래 headers에 반드시 token을 추가해줘야 한다.!!!!! 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'post',
        url: "{{ route('/getOptionPrice') }}",
        dataType: 'json',
        data: formData,
        success: function(data) {
             console.log(data);
        },
        error: function(data) {
             console.log("error" +data);
        }
    });
}