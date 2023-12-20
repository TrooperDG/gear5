import {products} from '../data/product_data.js';
import {cart} from '../data/cart.js';



let productsHTML = '';

products.forEach(product => {
    productsHTML += `
    <div class="product"> 
        <div class="product-image">
            <img src="${product.image}" alt="">
        </div>

        <div class="product-details-container">
            <div class="product-name-container">
                <div class="product-name">${product.name} </div>
            </div>
                <div class="product-review">

                    <div class="product-review-stars">
                        <img src="ratings/rating-${product.review.stars *10}.png" alt="">
                    </div>
                    <div class="product-review-count">${product.review.count} </div>

                </div>
                <div class= "product-price-container">
                    <div class="rupee-symbol"> &#8377 </div>
                    <div class="product-price">${product.price} </div>
                </div>
            <div class="product-addToCart-container">
                <button class="addToCart-button js-addToCart-button"  data-product-id="${product.id}">Add To Cart</button>
            </div>
        </div>
         

</div>

    `

    document.querySelector('.js-product-container')
    .innerHTML= productsHTML;
});



document.querySelectorAll('.js-addToCart-button')
    .forEach((button) =>{
        button.addEventListener('click', ()=>{
            // console.log('Added Product');
            // console.log(button.dataset.productId)
            const productId= button.dataset.productId;

            let matchingItem;
            cart.forEach((item)=>{
                if(productId === item.productId){
                    matchingItem= item;
                }
            })

            if(matchingItem){
                matchingItem.quantity += 1;
            }else{
                cart.push({
                    productId: productId,
                    quantity: 1
                })
            }

            let cartQuantity = 0;

            cart.forEach((item) =>{
                cartQuantity += item.quantity;
            })
            
            document.querySelector('.js-cart-value')
                .innerHTML= cartQuantity;

            console.log(cart)
            console.log(cartQuantity)
        })
    })


