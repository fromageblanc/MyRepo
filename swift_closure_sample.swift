// クロージャ

// 明示的に型指定
var valClosure1:(Int,Int)->Int = { (x:Int,y:Int) -> Int in 
    return x + y 
}

// 型推論利用
var valClosure2 = { (x:Int,y:Int) -> Int in
    return x * y
}

// タプルで
var (a:Int,b:Int) = (5,5)
println(valClosure1(a,b))
println(valClosure2(a,b))

// クロージャ式をメソッドのパラメタとして使用
func testFunction(x:Int,y:Int,closure:(Int,Int)->Int){
    println(closure(x,y))
}

var valClosure3:(Int,Int)->Int = { (a:Int,b:Int) -> Int in
    return a + b
}

println(testFunction(4,4,valClosure3)) // 4 + 4

var valClosure4 = { (a:Int,b:Int) -> Int in
    return a * b
}

println(testFunction(4,4,valClosure4)) // 4 * 4

// 直接クロージャ式をパラメタ指定
println(testFunction(5,5,{(a,b) -> Int in 
    return a + b
}))

// 単独式のreturnは省略できる
println(testFunction(5,5,{(a,b) -> Int in 
    a + b
}))

// キャプチャ ※{}内変数を保持
/* 
testFunction2は、Int型の変数[a:Int]を受け取り、引数を持たないInt型を返す関数型[()->Int]（関数のポインタ）を戻す
*/
func testFunction2(a:Int)->()->Int {
    var ans = 1
    return { ()->Int in   // ()->Int型関数の定義
        ans = ans * a
        return ans        // キャプチャ対象
    }
}

var pFunc = testFunction2(3)
println(pFunc()) // 3
println(pFunc()) // 9
println(pFunc()) // 27


