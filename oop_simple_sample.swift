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
    
    // 年の数ほえる
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

var dog1 = Dog(name:"pochi",age:3)
println("僕は\(dog1.name)です。\(dog1.age)才です。")
// ３つ年を取る
dog1.getOld(3)
dog1.wow()

var dog2 = Dog(name:"taro",age:10)
// ５つ年を取る
dog2.getOld(5)
println("僕は\(dog2.name)です。\(dog2.age)才です。")
dog2.wow()

//実行結果
//僕はpochiです。3才です。
//Vow! Vow! Vow! Vow! Vow! Vow! 
//僕はtaroです。15才です。
//Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! Vow! 

// さて、ここまでのコードで何がオブジェクト指向なのか？
//----------------------------------------------
//１．犬の"型"を利用し、dog1とdog2という実体を生成した。
//２．インスタンスのプロパティであるageに触ることなく年をとった。
//３．インスタンス、dog1とdog2は同じプロパティ、メソッドを持つがそれぞれが個別の振る舞いをする
//----------------------------------------------
