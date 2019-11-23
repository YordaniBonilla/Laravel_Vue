<template>

<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- @auth -->
            <!-- <h3>BIENVENIDO: {{ auth()->user()->name}} </h3> -->
            <!-- @endauth -->
            
            <h1>Inicio</h1>
            
            <div class="container">
                <div class="row pb-3">
                    <div class="col-12">
                        <img class=" display-4 img-fluid" src="img/desayuno.png" alt="elige tu desayuno">
                    </div>
                </div>
                <ul class="list-group">
                        <!-- @if(Session::has('success'))
                                            <div class="alert alert-success">
                                             {{Session::get('success')}}
                                            </div>
                                            @endif
                        @forelse($products as $product) -->
                    <li class="list-group-item border-0 mb-3 " v-for="product in products">
                        <div class="row d-flex justify-content-between align-items-center"> 
                            <div class="col-sm-4">
                                <span class="text-secondary font-weight-bold">
                                     {{ product.name }} 
                                </span>
                            </div>
                            <div class="col-sm-4">
                                <span class="text-secondary font-weight-bold">
                                    <!-- number_format($product->price, 2) -->
                                    {{  product.price}}
                                </span>
                            </div>
                            <!-- @auth -->
                                
                            <div class="col-sm-4" v-if="auth">
                                <span>
                                	<!-- {{route('add', [ $product->getRouteKey() ]) }} -->
                                            <!--recordar de pasar routekey a funcion-->

                                            <button class="btn btn-primary" v-on:click="addToCart(product.id)">Añadir al carrito</button>
                                            {{ product.descripcion }}
                                	
                                </span>
                            </div>
                            <!-- @else -->
                            <div class="col-sm-4" v-else >
                                <span>
                                    Para comprar registrate
                                </span>
                            </div>
                            <!-- @endauth -->

                        </div>
                    </li>
                                
                    <hr />     
                    	<li class="list-group-item border-0 mb-3" v-if="!products.length">
                        	Por el momento no tenemos Desayunos
                        </li>                                
                    
                    
                </ul>
            </div>
        </div>
    </div>
</div> 
</template>

<script>
    export default {
		name: 'Home',
		data: function () {
			return {
				auth: true,
				products: []
			}
		},
		methods: {
			addToCart(routeKey) {
			    this.axios.post(`/add/${routeKey}`).then(({data}) => {
			    	this.$parent.getCartContent();	
			    });

			}
		},
		mounted() {
			this.axios.get('/cartProducts').then(({data}) => this.products = data);
		}
    }
</script>
