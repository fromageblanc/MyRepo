//
//　超簡単なオブジェクト指向の説明プログラム in Swift
//

// 犬クラス
class Dog {

    var name:String
    var age:Int
    
    init(name:String,age:Int){
        self.name = name ?? "nanashi"
        self.age = age ?? 1
    }
    
    // 年の数だけほえる
    func wow(){
        for _ in 0..<self.age {
            print("Vow! ")
        }
        println()
    }
    // 年を取る
    func getOld(y:Int){
        self.age += y
    }
}

// 犬１．ポチ
var dog1 = Dog(name:"pochi",age:3)
println("僕は\(dog1.name)です。\(dog1.age)才です。")
// ３つ年を取る
dog1.getOld(3)
dog1.wow()

// 犬２．タロ
var dog2 = Dog(name:"taro",age:10)
// ５つ年を取る
dog1.getOld(5)
println("僕は\(dog1.name)です。\(dog1.age)才です。")
dog1.wow()

/* 実行結果
僕はpochiです。3才です。
Vow! Vow! Vow! Vow! Vow! Vow! 
僕はpochiです。11才です。
Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! 
*/


// さて、ここまでのコードで何がオブジェクト指向なのか？
//----------------------------------------------
//１．犬の"型"を利用し、dog1とdog2という実体を生成した。
//２．インスタンスのプロパティであるageに触ることなく年をとった。
//３．インスタンス、dog1とdog2は同じプロパティ、メソッドを持つがそれぞれが個別の振る舞いをする
//----------------------------------------------
