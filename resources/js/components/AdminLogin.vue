<template>
	<div class="login-form">
		<div class="main-div">
			<div class="panel">
				<h2>Admin Login</h2>
				<p>Please enter your email and password</p>
			</div>
			<form ref="loginForm">

				<div class="form-group">
					<input type="email" name="email" v-model="model.loginData.email" class="form-control" id="inputEmail"
						placeholder="Email Address">
				</div>

				<div class="form-group">

					<input type="password" name="password" v-model="model.loginData.password" class="form-control"
						id="inputPassword" placeholder="Password">

				</div>
				<div class="forgot">
					<a href="reset.html">Forgot password?</a>
				</div>
				<button type="submit" @click.prevent="submit" class="btn btn-primary">Login</button>

			</form>
		</div>
		<p class="botto-text"> Designed by Sunil Rajput</p>
	</div>
</template>
<style>
.form-heading {
	color: #fff;
	font-size: 23px;
}

.panel h2 {
	color: #444444;
	font-size: 18px;
	margin: 0 0 8px 0;
}

.panel p {
	color: #777777;
	font-size: 14px;
	margin-bottom: 30px;
	line-height: 24px;
}

.login-form .form-control {
	background: #f7f7f7 none repeat scroll 0 0;
	border: 1px solid #d4d4d4;
	border-radius: 4px;
	font-size: 14px;
	height: 50px;
	line-height: 50px;
}

.main-div {
	background: #ffffff none repeat scroll 0 0;
	border-radius: 2px;
	margin: 10px auto 30px;
	max-width: 38%;
	padding: 50px 70px 70px 71px;
}

.login-form .form-group {
	margin-bottom: 10px;
}

.login-form {
	text-align: center;
}

.forgot a {
	color: #777777;
	font-size: 14px;
	text-decoration: underline;
}

.login-form .btn.btn-primary {
	background: #f0ad4e none repeat scroll 0 0;
	border-color: #f0ad4e;
	color: #ffffff;
	font-size: 14px;
	width: 100%;
	height: 50px;
	line-height: 50px;
	padding: 0;
}

.forgot {
	text-align: left;
	margin-bottom: 30px;
}

.botto-text {
	color: #ffffff;
	font-size: 14px;
	margin: auto;
}

.login-form .btn.btn-primary.reset {
	background: #ff9900 none repeat scroll 0 0;
}

.back {
	text-align: left;
	margin-top: 10px;
}

.back a {
	color: #444444;
	font-size: 13px;
	text-decoration: none;
}
</style>
<script>
export default {
	data() {
		return {
			errorList: '',
			model: {
				loginData: {
					email: "",
					password: "",
				}
			},
		}
	},
	methods: {
		async submit() {
			let $this = this;
			await axios.post('/api/authlogin', this.model.loginData).then(response => {
				if (response.data.status) {
					console.log(response.data);
					localStorage.setItem('token', response.data.token)
				}
				$this.$router.push({ name: "product List" })
				console.log(response);
			}).catch(error => {
				console.log(error)
			})
		}
	},
	mounted() {
		console.log('Component mounted.')
	}
}
</script>
