// オプショナル型あれこれ

// 「?」付きとなしは似て非なるもの
var i:Int = 1 // Int
var ii:Int? = 1 // オプショナル型でラップしたInt型

// 1 . Forced Unwrapping

println(i + 5) // 6
//println(ii + 5) // エラー
println(ii! + 5) // Int型に強制アンラップ 

// 2 . Optional Chaining

class MyClass{
    func sayHello(){
        println("Hello!")   
    }
}

var me:MyClass? = MyClass()
//me.sayHello() // エラー
me?.sayHello() // Optional Chaining  > Hello!
me = nil
me?.sayHello() // nil ランタイムエラーにならない
//me!.sayHello() // ランタイムエラー

// 3 . Optional Binding
/*
条件式中で宣言
オプショナル型変数を代入された変数は非オプショナル型
スコープは条件ブロック内
*/
var you:MyClass? = MyClass()

if var tmp = you {
    println(tmp) // main.MyClass
}
//println(tmp) // 未定義エラーになる

// 4 . Implicitly Unwrapped Optionl Type
var we:MyClass! = MyClass()
we.sayHello() // アンラップ不要
we = nil
//we.sayHello() // ランタイムエラー

