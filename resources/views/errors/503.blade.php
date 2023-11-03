<title>Site Maintenance</title>
<style>
    * {
  margin:0;
  padding:0;
}

html, body {
  height: 100%;
  background: #434A54;
  color: white;
  font-family: 'Inconsolata', monospace;
  font-size: 100%;
}
.maintenance {
  text-transform: uppercase;
  margin-bottom: 1rem;
  font-size: 3rem;
}
.container {
  display: table;
  margin: 0 auto;
  max-width: 1024px;
  width: 100%;
  height: 100%;
  align-content: center;
  position: relative;
  box-sizing: border-box;
  .what-is-up {
    position: absolute;
    width: 100%;
    top: 50%;
    transform: translateY(-50%);
    display: block;
    vertical-align: middle;
    text-align: center;
    box-sizing: border-box;
    .spinny-cogs {
      display: block;
      margin-bottom: 2rem;
      .fa {
        &:nth-of-type(1) {
          @extend .fa-spin-one;
        }

        &:nth-of-type(3) {
          @extend .fa-spin-two;
        }
      }
    }
  }
}

@-webkit-keyframes fa-spin-one {
  0% {
    -webkit-transform: translateY(-2rem) rotate(0deg);
    transform: translateY(-2rem) rotate(0deg);
  }
  100% {
    -webkit-transform: translateY(-2rem) rotate(-359deg) ;
    transform: translateY(-2rem) rotate(-359deg) ;
  }
}
@keyframes fa-spin-one {
  0% {
    -webkit-transform: translateY(-2rem) rotate(0deg);
    transform: translateY(-2rem) rotate(0deg);
  }
  100% {
    -webkit-transform: translateY(-2rem) rotate(-359deg) ;
    transform: translateY(-2rem) rotate(-359deg) ;
  }
}
.fa-spin-one {
  -webkit-animation: fa-spin-one 1s infinite linear;
  animation: fa-spin-one 1s infinite linear;
}

@-webkit-keyframes fa-spin-two {
  0% {
    -webkit-transform: translateY(-.5rem) translateY(1rem) rotate(0deg);
    transform: translateY(-.5rem) translateY(1rem) rotate(0deg);
  }
  100% {
    -webkit-transform: translateY(-.5rem) translateY(1rem) rotate(-359deg);
    transform: translateY(-.5rem) translateY(1rem) rotate(-359deg);
  }
}
@keyframes fa-spin-two {
  0% {
    -webkit-transform: translateY(-.5rem) translateY(1rem) rotate(0deg);
    transform: translateY(-.5rem) translateY(1rem) rotate(0deg);
  }
  100% {
    -webkit-transform: translateY(-.5rem) translateY(1rem) rotate(-359deg);
    transform: translateY(-.5rem) translateY(1rem) rotate(-359deg);
  }
}
.fa-spin-two {
  -webkit-animation: fa-spin-two 2s infinite linear;
  animation: fa-spin-two 2s infinite linear;
}
.made-by-me {
  position: fixed;
  text-decoration: none;
  box-sizing: border-box;
  right: 16px;
  bottom: 16px;
  width: 44px;
  height: 44px;
  display: block;
  border-radius: 100%;
  border: 2px solid white;
  box-shadow: 0 0 30px 0 rgba(black, .3);
  font-size: 0px;
  background: url("https://assets.codepen.io/50099/internal/avatars/users/default.png") no-repeat center;
  background-size: cover;
}
</style>

<div class="container">
  <div class="what-is-up">

    <div class="spinny-cogs">
      <i class="fa fa-cog" aria-hidden="true"></i>
      <i class="fa fa-5x fa-cog fa-spin" aria-hidden="true"></i>
      <i class="fa fa-3x fa-cog" aria-hidden="true"></i>
    </div>
    <h1 class="maintenance">Under Maintenance</h1>
    <h2><p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. Otherwise we&rsquo;ll be back online shortly!</p>
        <p>&mdash; PT Ali Bin Ali Wisata</p></h2>
  </div>
</div>