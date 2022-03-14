const forms = document.querySelectorAll('.form-submit')
forms.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault()
        fetch('request.php', {
            method: 'POST',
            body: new FormData(form)
        })
        .then(res => res.json())
            .then(data => {
                var notyf = new Notyf 
                if (data.msgClass == 'success') {
                   notyf.success({
                        message: data.msg,
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                            }
                   })
                    loadCartItemNumber();
                    loadProductImages();
                } else {
                    notyf.error({
                        message: data.msg,
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                            }
                    })
                    loadCartItemNumber()
                    loadProductImages();
                }
        })
        .catch(err => console.log(err))

    })
})





window.onload = () => {
    loadCartItemNumber();
    // loadProductImages()
};
    
    const loadCartItemNumber = () => {
        fetch('num.php')
        .then(res => res.text())
        .then(data => document.querySelector('#cart-num').innerHTML = data)
        .catch(error => console.log(error))
    }
    
    // const loadProductImages = () => {
    //     fetch('pix.php')
    //         .then(res => res.json())
    //         .then(data => {
    //             if (data.msg !== 'success') {
    //                 // nothing in array
    //                 output = `
    //                     <tr>
    //                         <!-- <td class="si-pic"><img height="70" width="70" src="${product.image_path}" alt=""></td> -->
    //                         <td class="si-text">
    //                             <div class="product-selected">
    //                                 <p>No item in cart</p>
    //                                 <!-- <h6>${product.image_name}</h6> -->
    //                             </div>
    //                         </td>
    //                         <!-- <td class="si-close">
    //                             <i class="ti-close"></i>
    //                         </td> -->
    //                     </tr>
    //                 `
    //             } else {
    //                 output = ''
    //                 data.forEach(product => {
    //                     output += `
    //                         <tr>
    //                             <td class="si-pic"><img height="70" width="70" src="${product.image_path}" alt=""></td>
    //                             <td class="si-text">
    //                                 <div class="product-selected">
    //                                     <p>$${product.current_price}.00 x ${product.quantity}</p>
    //                                     <h6>${product.image_name}</h6>
    //                                 </div>
    //                             </td>
    //                             <td class="si-close">
    //                                 <i class="ti-close"></i>
    //                             </td>
    //                         </tr>
    //                     `
    //                 })
    //             }
    //             document.querySelector('tbody').appendChild(output)
    //         })
    //     .catch(err => console.log(err))
    // }
