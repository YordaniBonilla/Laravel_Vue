<template>

<h1>Hello Contactos</h1>

</template>

<script>
	export default {
		name: 'Contact',
		computed: {
          isContactPage() {
    	    if(this.$route.path == "/contact-us") {
        	  return true
        	} else {
          	return false
        	}
          }
    	}
	}
</script>
