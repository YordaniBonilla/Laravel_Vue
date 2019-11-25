<template>
<div>
<h1>Hello Contactos</h1>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
<p>otro taco otro taco</p>
</div>
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
