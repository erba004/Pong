document.body.style.margin = '0px'
const canvas = document.querySelector('canvas')
const c = canvas.getContext('2d')

canvas.width = 1440
canvas.height = 787

c.fillRect(0, 0, canvas.width, canvas.height)

class Sprite {
    constructor({position, velocity, color = 'white'}) {
        this.position = position
        this.velocity = velocity
        this. width = 30
        this.height = 150
        this.color = color
    }

    draw() {
        c.fillStyle = this.color
        c.fillRect(this.position.x, this.position.y, this.width, this.height)
    }

    update() {
        this.draw()
        this.position.x += this.velocity.x
        this.position.y += this.velocity.y

        if (this.position.y + this.height + this.velocity.y >= canvas.height) {
            this.position.y = canvas.height - 150
            console.log('bot')
        } else if (this.position.y <= 0) {
            this.position.y = 0
            console.log('top')
        }
    }

}

class BallClass {
    constructor({position, velocity, color = 'white'}) {
        this.position = position
        this.velocity = velocity
        this.width = 30
        this.height = 30
        this.lastkey
        this.color = color
    }

    draw() {
        c.fillStyle = this.color
        c.fillRect(this.position.x, this.position.y, this.width, this.height)
    }

    update() {
        this.draw()
        this.position.x += this.velocity.x
        this.position.y += this.velocity.y
    }

}

const player1 = new Sprite({
    position: {
        x: 150,
        y: (canvas.height/2) - 75
    },
    velocity: {
        x: 0,
        y: 0

    }

})

const player2 = new Sprite({
    position: {
        x: canvas.width - 150,
        y: (canvas.height/2) - 75
    },
    velocity: {
        x: 0,
        y: 0

    }

})

const ball = new BallClass({
    position: {
        x: (canvas.width/2) - 15,
        y: (canvas.height/2) - 15
    },
    velocity: {
        x: 0,
        y: 0
    }
})

console.log(player1)
console.log(player2)

const keys =  {
    w: {
        pressed: false
    },
    s: {
        pressed: false
    },
    ArrowUp: {
        pressed: false
    },
    ArrowDown: {
        pressed: false
    }
}

function rectangularCollision({rectangle1, rectangle2}) {


}

function animate() {
    window.requestAnimationFrame(animate)
    c.fillStyle = 'black'
    c.fillRect(0, 0, canvas.width, canvas.height)
    player1.update()
    player2.update()
    ball.update()

    player1.velocity.y = 0
    player2.velocity.y = 0

    //player1 movement
    if (keys.w.pressed && player1.lastkey === 'w') {
        player1.velocity.y = -5
    } else if (keys.s.pressed && player1.lastkey === 's') {
        player1.velocity.y = 5
    }

    //player2 movement
    if (keys.ArrowUp.pressed && player2.lastkey === 'ArrowUp') {
        player2.velocity.y = -5
    } else if (keys.ArrowDown.pressed && player2.lastkey === 'ArrowDown') {
        player2.velocity.y = 5
    }


}

animate()

console.log(player2)
console.log(ball)

window.addEventListener(('keydown'), (event) => {
    switch (event.key) {
        case 'w':
            keys.w.pressed = true
            player1.lastkey = 'w'
            break
        case 's':
            keys.s.pressed = true
            player1.lastkey = 's'
            break
        case 'ArrowUp':
            keys.ArrowUp.pressed = true
            player2.lastkey = 'ArrowUp'
            break
        case 'ArrowDown':
            keys.ArrowDown.pressed = true
            player2.lastkey = 'ArrowDown'
            break
    }
})

window.addEventListener(('keyup'), (event) => {
    switch (event.key) {
        case 'w':
            keys.w.pressed = false
            break
        case 's':
            keys.s.pressed = false
            break
        case 'ArrowUp':
            keys.ArrowUp.pressed = false
            break
        case 'ArrowDown':
            keys.ArrowDown.pressed = false
            break
    }
})