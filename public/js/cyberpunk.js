// Watching Breaking Bad :)
Meth = Math;
canvas = document.createElement("canvas");
ctx = canvas.getContext("2d");

config = {
  count: 600,
  spawnRange: 200,
  color1: "#B80000",//紅色
  color2: "#E8E8E8",//灰色
  clearColor: "#404040",
  clean: function(){
    ctx.fillRect(0, 0, w, h);
    ctx.fillStyle = config.clearColor;
  },
  radius: 0.8,
  alpha: 0.025,
  nt: 0,
}

function reset() {
  w = canvas.width = window.innerWidth;
  h = canvas.height = window.innerHeight;
  ctx.fillRect(0, 0, w, h);
  ctx.fillStyle = config.clearColor;
}
reset();
window.addEventListener("resize", reset);



class Particle {
  constructor() {
    let random = Meth.random();
    this.x = random > 0.3 ? (w/2-config.spawnRange/2)+(Meth.random()*config.spawnRange):0;
    this.x = random > 0.6 ? w-1:this.x;
    this.y = Meth.random() > 0.5 ? 0:h-1;
    this.y = random > 0.6 || random <0.3 ? (h/2-config.spawnRange/2)+(Meth.random()*config.spawnRange):this.y;
    this.s = Meth.random() * 2;
    this.x_d = this.x == 0 ? 1:0;
    this.x_d = this.x == w-1 ? -1:this.x_d;
    this.y_d = this.y == 0 ? 1:0;
    this.y_d = this.y == h-1 ? -1:this.y_d;
    this.turn_right = 0;
    this.turn_left = 0;
    //this.radius = random > .2 ? Meth.random() * 1 : Meth.random() * 3;
    //this.radius = random > .8 ? Meth.random() * 2 : this.radius;
    this.radius = 3.3;
    this.color  = random > 0.5 ? config.color1 : config.color2;
    //this.color  = random > .5 ? "hsl(350, 100%, 50%)" : "hsl(220, 100%, 50%)";
  }

  render() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius * config.radius, 0, 2 * Meth.PI);
    ctx.fillStyle = this.color;
    ctx.fill();
    ctx.closePath();
  }

  director(){
    if(this.x_d==1){
      this.x+=this.s;
    }
    else if (this.x_d==-1){
      this.x-=this.s;
    }
    else{
        if(Meth.random()>0.7&&this.turn_left<=0&&this.turn_right<=0){
          Math.random()>0.5?this.turn_left=30:this.turn_right=30;
        }
        if(this.turn_left>0){
          this.x-=this.s;
          this.turn_left-=1;
        }
        else if(this.turn_right>0){
          this.x+=this.s;
          this.turn_right-=1;
        }
    }
    if(this.y_d==1){
      this.y+=this.s;
    }
    else if (this.y_d==-1){
      this.y-=this.s;
    }
    else{
      if(Meth.random()>0.7&&this.turn_left<=0&&this.turn_right<=0){
        Math.random()>0.5?this.turn_left=30:this.turn_right=30;
      }
      if(this.turn_left>0){
        this.y-=this.s;
        this.turn_left-=1;
      }
      else if(this.turn_right>0){
        this.y+=this.s;
        this.turn_right-=1;
      }
    }
  }

  move() {
    
    //this.x += Meth.cos(this.a) * this.s;
    //this.y += Meth.sin(this.a) * this.s;
    //this.a += Meth.random() * 0.8 - 0.4; // direction
    this.director();

    if (this.x < 0 || this.x > w) {  
      return false; //刪除視窗外的點
    }

    if (this.y < 0 || this.y > h ) {
      
        
      return false;
    }
    this.render();
    return true;
    
  }
}


let particles = [];
function emit(num) {
  for (var i = 0; i < num; i++) {
    setTimeout(
      function () {
        particles.push(new Particle());
      },
      i * 20);
  }
  return particles.length;
}

function clear() {
  ctx.globalAlpha = config.alpha;//設置圖片透明度
  ctx.fillStyle = config.clearColor;
  ctx.fillRect(0, 0, w, h);
  ctx.globalAlpha = 1;
}
let bt=0;
function update() {
  ctx.globalCompositeOperation = "lighter";
  particles = particles.filter(function (p) {
    return p.move();
  });
  ctx.globalCompositeOperation = "source-over";
  clear();
  if(bt==0){
    requestAnimationFrame(update); //執行動畫
  }
  document.body.style.background = "url(" + canvas.toDataURL() + ")"//將canvas設為背景
}
emit(config.count);
update();
//setTimeout(function(){bt=1; },30000);

