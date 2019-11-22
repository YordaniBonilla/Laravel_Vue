<template>

<h1>Hello Nosotros</h1>

</template>

<script>
	export default {
		name: 'Nav',
		computed: {
          isUsPage() {
    	    if(this.$route.path == "/us") {
        	  return true
        	} else {
          	return false
        	}
          }
    	}
	}
</script>
