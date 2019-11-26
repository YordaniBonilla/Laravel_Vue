<template>
  <div class="container">
  	<nav class="navbar navbar-expand-lg navbar-light bg-light text-dark ">
	   <a class="navbar-brand" href="/">
	   <img v-bind:src="'/images/Logo.jpg'" height="75px"></img>
	   </a>

	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button> 

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="nav nav-pills nav-fill">
	      <li class=" nav-item ">
	 	  	<router-link to="/"  class="nav-link" :class="isCurrentPage('/') && 'color1'">{{select('/',"&lt; Home &sol;&gt;", "Home")}}</router-link>
	      </li>

	      <li class=" nav-item">
	 	  	<router-link to='/contact-us' class="nav-link" :class="isCurrentPage('/contact-us') && 'color1'" >{{select('/contact-us',"&lt; Contacto &sol;&gt;", "Contacto")}}</router-link>
	      </li>

	      <li class=" nav-item">
	 	  	<router-link to="/us" class="nav-link" :class="isCurrentPage('/us') && 'color1'" >{{select('/us',"&lt; Nosotros &sol;&gt;", "Nosotros")}}</router-link>
	      </li>

        <li class=" nav-item">
        <router-link to="/products" class="nav-link" :class="isCurrentPage('/products') && 'color1'" >{{select('/products',"&lt; Products &sol;&gt;", "Products")}}</router-link>
        </li>
           <!-- @auth only -->
	       <li class="nav-item dropdown ">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#shoppingCartModal">
                        Cart
                    </button>
            </li>
<!-- 

                <li class="nav-item">
                    <a class="nav-link" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesion
                    </a>
                </li> -->

                <!-- End auth only -->

                <!-- Shopping cart modal -->
                 <div class="modal fade" id="shoppingCartModal" tabindex="-1" role="dialog"
                 aria-labelledby="shoppingCartModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shoppingCartModalTitle">Shopping cart</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody v-for="cartItem in cartContent">

                                <!-- @foreach(Cart::content() as $cartItem) -->
                                    <tr>
                                        <td>
                                            <!-- Remove product button -->
                                            <!-- <a href="{{ route('remove', [ $cartItem->rowId ]) }}">x</a> -->
                                            <button class="btn" v-on:click="removeProduct(cartItem.rowId)">X</button>
                                        </td>
                                         <td> {{ cartItem.name }}</td> 
                                         <td> {{ cartItem.qty }}</td> 
                                         <td> {{ cartItem.price }}USD</td> 
                                         <!-- <td>{{ number_format($cartItem->price, 2) }} USD</td> -->
                                         <td> {{ cartItem.price }}USD</td>
                                        <!--$cartItem->total fue usado pero dava precio con taxis/iva de donde se le agreo ese impuesto? no lo pude encontrar...0.0?-->
                                    </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- Total price of whole cart -->
                                    <!-- <td class="uk-text-bold">Total: {{ number_format(Cart::subtotal(), 2) }} USD</td> -->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <!-- Clear shopping cart button -->
                             <button v-on:click="empty" class="btn btn-danger">Vaciar</button> 
                            <!-- Proceed to checkout button -->
                            <button v-on:click="checkout" class="btn btn-danger">Pagar</button> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- @can('products.index') -->
                <li class="nav-item">
                    <!-- <a class="nav-link" href="{{route('products.index') }}">Productos</a> -->
                </li>
              <!--   @endcan
                @can('users.index')
  -->               <li class="nav-item">
                    <!-- <a class="nav-link" href="{{route('users.index') }}">Usuarios</a> -->
                </li>
                <!-- @endcan -->
                <!-- @can('roles.index') Nombre del permiso -->
                <li class="nav-item">
                	<router-link to="/roles"  class="nav-link" :class="isCurrentPage('/roles') && 'color1'">{{select('/roles',"&lt; Roles &sol;&gt;", "Roles")}}</router-link>
                    <!-- <a class="nav-link" href="{{route('roles.index') }}">Roles</a> <Nombre de la ruta--> 
                </li>
                <!-- @endcan -->
                

                <!-- @else  -->

                    <li class="nav-item">
                    	<router-link to="/login"  class="nav-link" :class="isCurrentPage('/login') && 'color1'">{{select('/login',"&lt; Login &sol;&gt;", "Login")}}</router-link>
                        <!-- <a class="nav-link {{ modoActivo( 'login' )}}" href="{{ route('login') }}"> -->
                           <!--  Iniciar sesion -->
                        </a>
                    </li>
                    <li class="nav-item">
                    	<router-link to="/register"  class="nav-link" :class="isCurrentPage('/register') && 'color1'">{{select('/register',"&lt; Register &sol;&gt;", "Register")}}</router-link>
                        <!-- <a class="nav-link {{ modoActivo( 'register' )}}" href="{{ route('register') }}">Registro</a> -->
                    </li>
                <!-- @endauth -->
	    </ul>
	</div>
	</nav><!-- 
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> -->
    
    <main>
    	<router-view></router-view>
    </main>

  </div>
</template>

<script>
	export default {
		name: 'Nav',
        data() {
            return {
                cartContent: []
            }
        },
		methods: {
          isCurrentPage: function(url) {
    	    if(this.$route.path == url) {
        	  return true
        	} 
          	return false
          },
          select(path,ifCorrect,defaultOption) {
    			if(this.isCurrentPage(path)) {
    				return ifCorrect;
    			}
    			return defaultOption;
    		},
           removeProduct(rowId) {
              this.axios.get(`/remove/${rowId}`).then(response => console.log(response.data));
              this.getCartContent();
           },
           getCartContent() {
            this.axios.get('/getCartContent').then(({data}) => this.cartContent = data);
           },
           empty() {
             this.axios.get('/empty').then(({data}) =>  console.log(data));
             this.getCartContent();
           },
           checkout() {
            this.axios.get('checkout').then(({data}) =>  console.log(data));
           }
    	}
	}
</script>






<style scoped >

  .color1 {
	color: black;
    border-bottom: 3px solid black;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;

  }
  a {
    text-decoration: none;
  }

</style>