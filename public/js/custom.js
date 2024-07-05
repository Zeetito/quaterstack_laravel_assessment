    // variables indipenedent of page refresh
    var saved_signature = localStorage.getItem('signature');


    document.body.onload = function() {

        
        var canvas = document.getElementById('signature-pad');
        if(canvas){
            // Initializing sign pad
            var signaturePad = new SignaturePad(canvas);
            signatureData = signaturePad.toDataURL();
            signaturePad.onEnd = updateSignatureData;



            // These Functions are for the canvas page

            // Update the signature every time there's change
            function updateSignatureData() {
                signatureData = signaturePad.toDataURL();
                document.getElementById('signature-data').value = signatureData;
            }



            // Check if printable_signature element is there, receive the signature data
            var printable_signature = document.getElementById('printable_signature');
            if (printable_signature) {
                printable_signature.innerHTML = document.getElementById('signature-data').innerHTML;
            }

            // Check if signature_pad element is there, receive the signature data
            
            if (saved_signature) {
                canvas.innerHTML =  signaturePad.fromDataURL(saved_signature);
            }

            

            // onclick of clear button clearsignature 
            document.getElementById('clear_signature').addEventListener('click', clearSignature);
        



        }else{
            if(saved_signature){
                localStorage.removeItem('signature');
                saved_signature = null;
            }
        }


        // Check if proposal form exists
        if(document.getElementById('proposal-edit-form')){  

            document.getElementById('proposal-edit-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                var signatureData = signaturePad.toDataURL(); // Get signature image data
                // Update hidden input field with signature data
                document.getElementById('signature-data').value = signatureData;

                //  console.log('Signature Data:', signatureData);

                // Check if signature field is empty
                if (signaturePad.isEmpty()) {
                    
                    document.getElementById('error_message').innerHTML = 'The signature field is required.';
                } else {
                    document.getElementById('error_message').innerHTML = '';

                    // Optional: Submit the form programmatically if needed
                    localStorage.setItem('signature', signatureData);
                    event.target.submit();
                }
            });
        }
                

            // Function to clear the signature
            function clearSignature() {

                saved_signature = null;
                localStorage.removeItem('signature');
                signaturePad.clear();
            }


        // Function to save the signature
        window.addEventListener('alert', event => { 
            const { title, message, type, showCancelButton,cancelButtonText,confirmButtonText,id } = event.detail;
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                showCancelButton: showCancelButton,
                confirmButtonColor: '#d33',
                // cancelButtonColor: '#3085d6',
                cancelButtonText:cancelButtonText,
                confirmButtonText:confirmButtonText,
            })
            return;
        });
    

        // Function to handle button click
        function handleButtonClick(id,title,type,message,showCancelButton,cancelButtonText,confirmButtonText) {


        // Create a CustomEvent with dynamic details
        const alertEvent = new CustomEvent('alert', {
            detail: {
                message: message,
                title: title,
                type: type,
                showCancelButton: showCancelButton,
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText,
                id: id,
                submit:true,

            }
        });

        // Dispatch the custom event
        window.dispatchEvent(alertEvent);

        
    }

    // Add event listener to the button

        // Add event listeners to all elements with class 'triggerButton'
    document.querySelectorAll('.deleteButton').forEach(button => {
        button.addEventListener('click', function() {
            const buttonId = this.getAttribute('data-id');

            const name = document.getElementById('name_'+buttonId).value;
            const title = "Are you sure you want to delete Proposal for "+name;
            const type = "warning";
            const message = "";
            const confirmButtonColor = '#d33';
            const showCancelButton = true;
            const cancelButtonText =  'No, Cancel it!';
            const confirmButtonText = 'Yes, I am sure!';

            // document.getElementById(buttonId).addEventListener('click', function() {
                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    showCancelButton: showCancelButton,
                    cancelButtonText: cancelButtonText,
                    confirmButtonColor: confirmButtonColor,
                    confirmButtonText: confirmButtonText
                }).then((result) => {
                    if (result.isConfirmed) {
                        // The user clicked the confirm button
                        console.log('Confirmed');
                        document.getElementById('delete-form-'+buttonId).submit();
                        // Perform actions upon confirmation here
                    } else if (result.isDismissed) {
                        // The user clicked the cancel button or dismissed the alert
                        // console.log('Dismissed');
                        // Perform actions upon dismissal here
                    }
                });
            // });

            // handleButtonClick(buttonId,title,type,message,showCancelButton,cancelButtonText,confirmButtonText);

        });
    });

    // Listen for print action
    document.querySelectorAll('.PrintButton').forEach(button => {
        button.addEventListener('click', function() {
            // const buttonId = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');

            fetch(url, {
                method: 'GET', // or 'POST', 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json'
                }
            }) .then(response => response.json()) // Parse the JSON from the response
            .then(data => {
                console.log(data); // Log the parsed JSON data
                handleResponse(data); // Handle the response data
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'PDF-Download Error!',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });




        });
    });

    // Listen for sendPDFButton
    document.querySelectorAll('.SendPDFButton').forEach(button => {
        button.addEventListener('click', function() {
            const buttonId = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
    
            fetch(url, {
                method: 'GET', // or 'POST', 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json()) // Parse the JSON from the response
            
            .then(data => {
                console.log(data); // Log the parsed JSON data
                handleResponse(data); // Handle the response data
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    });


    

    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('save_icon')) {
            var div = event.target.parentElement;
            related_icon = event.target;
    
            // Get the input element
            var input = div.querySelector('.title_text_input');
    
            // Get the original h_tag
            var h_tag = document.createElement('h3');
            h_tag.className = "title_text font-medium text-2xl"; // Correctly setting class name
            h_tag.textContent = input.value;
    

    
            // Create a new icon element
            var icon = document.createElement('i');
            icon.classList = related_icon.classList;
            // Change the class to save_icon
            related_icon.classList.remove('fa', 'fa-save', 'save_icon');
            related_icon.classList.add('edit_icon','fa','fa-pencil');


            // related_icon.classList = icon.classList;

            // this.replaceWith(icon);

            // console.log(this);

            // Append the icon after the h_tag
            h_tag.appendChild(related_icon);

            // Replace input with h_tag
            input.replaceWith(h_tag);

    
        }else if(event.target && event.target.classList.contains('edit_icon')) {
            var div = event.target.parentElement.parentElement;
    
            // Create an input element to replace the h_tag
            var input = document.createElement('input');
            input.className = 'title_text_input';
            input.value = div.querySelector('h3').textContent;
    
            // Replace h_tag with input
            div.querySelector('h3').replaceWith(input);
            
            var icon = document.createElement('i');
            icon.classList =  event.target.classList;
            // Change the class to save_icon
            icon.classList.remove('fa', 'fa-pencil', 'edit_icon');
            icon.classList.add('save_icon','fa','fa-save');
            div.appendChild(icon);

        }




    });
    
    // Return json response in sweet alert


    // Handle response
    function handleResponse(response) {
        if (response.success) {
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }

    // Storable Js
    var el = document.getElementById('sortable-list');
    var sortable = Sortable.create(el, {
        animation: 150,
        ghostClass: 'blue-background-class'
    });
    
}