class Member {
    var name:String = ""
    var hp:Int = 0
    var level:Int {
        get{
            return self.level
        }
        set{
            self.hp += newValue * 10
        }
    }
    
    init(name:String?) {
        self.name = name ?? "ななし"
        self.level = 1
    }
    
    func attack(point:Int){
        println("\(self.name)の攻撃！\(point)ポイントのダメージを与えた")
    }
    func damage(dam:Int){
        
        self.hp -= dam
        if (self.hp <= 0 ) {
            println("\(self.name)は死にました")
        } else {
            println("残りＨＰは\(self.hp)")
        }
    }
}

var me = Member(name:"seiji")
println(me.name)
println(me.hp)
me.level = 2
println(me.hp)
me.attack(4)
me.damage(3)
me.damage(20)
me.damage(3)
me.damage(5)

/*
seiji
10
30
seijiが攻撃！4ポイントのダメージを与えた
残りＨＰは27
残りＨＰは7
残りＨＰは4
seijiは死にました
ななし
10
ななしは死にました
()
*/
