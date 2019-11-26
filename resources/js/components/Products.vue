<template>
    <div>
        <form @submit.prevent="editarNota(producto)" v-if="editarActivo">
        <h3>Editar producto</h3>
        
            <input type="text" class="form-control mb-2" placeholder="Producto" v-model="producto.nombre">

            <input type="number" class="form-control mb-2" placeholder="Precio" v-model="producto.precio">

            <input type="text" class="form-control mb-2" placeholder="Descripcion" v-model="producto.descripcion">
    
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-danger" @click="Cancelar()">Cancelar</button>
        </form>

        <form @submit.prevent="agregar()" v-else>
        <div v-if="msg" class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success">
                        {{msg}}
                    </div>
                </div>
            </div>
        </div>

            <h3>Agregar productos</h3>
            <input type="text" class="form-control mb-2" placeholder="Producto" v-model="producto.nombre">

            <input type="number" class="form-control mb-2" placeholder="Precio" v-model="producto.precio">

            <input type="text" class="form-control mb-2" placeholder="Descripcion" v-model="producto.descripcion">

            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>
    <h3 class="my-3">Tus notas</h3>
        <ul class="list-group my-3">

            <li class="list-group-item"
            v-for="(t,index) in productos" :key="index">
            <span class="badge badge-primary float-right"> {{t.updated_at}}</span>
                <p>{{t.name}}</p>
                <p>{{t.price}}</p>
                <p>{{t.description}}</p>
                <button class="btn btn-danger btn-sm" @click="eliminarNota(t,index)">
                    Eliminar
                </button>
                
                <button class="btn btn-warning btn-sm" @click="editar(t)">
                    Editar
                </button>


            </li>
        </ul>
    
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'Products',
    data() {
        return {
            productos:[],
            producto:{nombre:'',descripcion:'', precio:''},
            msg:"",
            editarActivo: false,
        }
    },
    created(){
        axios.get('/products')
        .then(res=>{
            this.productos = res.data;
        });
    },
    methods:{
        getProducto(){
        axios.get('/products')
            .then(res=>{
            this.productos = res.data;
        });
        },
        agregar(){
            const parametros ={
                nombre:this.producto.nombre,
                descripcion:this.producto.descripcion,
                precio:this.producto.precio,
            };
            axios.post('/products/store', parametros)
            .then(res =>{
                this.productos.push(res.data);
            });
            this.producto.nombre= "";
            this.producto.descripcion ="";
            this.producto.precio ="";

        },
        eliminarNota(t,index){
            axios.delete(`products/${t.id}`)
            .then(() =>{
                this.productos.splice(index,1)
            })
        },
        editar(t){
            this.editarActivo = true;
            this.producto.nombre = t.name;
            this.producto.precio =t.price;
            this.producto.descripcion = t.description;
            this.producto.id = t.id;
        },

        editarNota(producto){
            const parametros = {
                nombre: producto.nombre,
                precio: producto.precio,
                descripcion: producto.descripcion
            };
            axios.put(`/products/${producto.id}`, parametros)
            .then(res =>{
                this.editarActivo = false;
                this.msg = 'Producto Actualizado con éxito';
                const index = this.productos.findIndex(buscar => buscar.id === res.data.id);
                // alert(JSON.stringify(res.data))
                this.productos[index] = res.data;
                this.producto={nombre:'',descripcion:'', precio:''};
                this.getProducto();

            })
        },
        cancelar(){
            this.editarActivo =false;
            this.producto={nombre:'',descripcion:'',precio:''}
        }
    }
}
</script>
