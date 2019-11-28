<template>
  <div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-8 mx-auto">

            
            <!-- @if(session('status')) -->
            
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="alert alert-success">
                            <!-- {{ session('status')}} -->
                        </div>
                    </div>
                </div>
            </div>       
            <!-- @else -->
           
            <!-- action=" {{ route('contacto') }}" -->
            <form class="bg-white shadow rounded py-3 px-5 "  @submit="checkForm" action="/contact-us" method="POST">

                    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
                    <!-- @csrf {{-- esto sirve para generar un token y proteger la pagina de ataque xss --}} -->
                <div class="form-group">
                    <h1 class="display-4">Contacto</h1>
                    <hr />

                    <label for="Nombre">Nombre:</label>
                    <input class="form-control shadow-sm bg-O @error('Nombre') is-invalid @else border-0 @enderror"
                        id="Nombre"
                        name="Nombre"
                        placeholder="Nombre..."
                        type="text"
                        v-model="name"
                         > 
                </div>

                <div class="form-group">
                    <label for="Correo">Correo:</label>
                    <input class="form-control shadow-sm bg-O @error('Correo') is-invalid @else border-0 @enderror"
                            type="text"
                        name="Correo"
                        placeholder="Email" 
                        v-model="correo"
                        >
                </div>

                <div class="form-group">

                    <label for="Asunto">Asunto:</label>
                    <input class="form-control shadow-sm bg-O @error('Asunto') is-invalid @else border-0 @enderror"
                        type="text"
                        name="Asunto"
                        placeholder="Asunto"
                        v-model="asunto"
                        > 
                </div>

                <div class="form-group">
                    <label for="Contenido">Mensaje:</label>
                    <textarea class="form-control shadow-sm bg-O @error('Asunto') is-invalid @else border-0 @enderror" v-model="mensaje" name="Contenido"placeholder="Escribe aqui tu mensaje...">


                    </textarea> 
                </div>
                <input class="btn btn-danger btn-group-lg btn-block" type="submit" value="Enviar">            
            </form>
        </div>
    </div>
  </div>
</template>

<script>
	export default {
		name: 'Contact',
    data() {
      return {
        name: '',
        correo: '',
        asunto: '',
        mensaje: '',
        errors: []
      }
    },
    methods: {
      checkForm:function(e) {
      if(!this.validEmail(this.correo)) this.errors.push("Correo required.");
      if(this.name && this.correo && this.asunto && this.mensaje) return true;
      this.errors = [];
      if(!this.name) this.errors.push("Name required.");
      if(!this.asunto) this.errors.push("Asunto required.");
      if(!this.mensaje) this.errors.push("Mensaje required.");
      e.preventDefault();
      },
      validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
    }
}
</script>
