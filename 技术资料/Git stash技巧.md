#git stash和git stash pop 

git stash 可用来暂存当前正在进行的工作， 比如想pull 最新代码， 又不想加新commit， 或者另外一种情况，为了fix 一个紧急的bug,  先stash, 使返回到自己上一个commit, 改完bug之后再stash pop, 继续原来的工作。

##基础命令：

	$git stash
	$do some work
	$git stash pop

##进阶：

	git stash save "work in progress for foo feature"


当你多次使用’git stash’命令后，你的栈里将充满了未提交的代码，这时候你会对将哪个版本应用回来有些困惑，’git stash list’ 命令可以将当前的Git栈信息打印出来，你只需要将找到对应的版本号，例如使用’git stash apply stash@{1}’就可以将你指定版本号为stash@{1}的工作取出来，当你将所有的栈都应用回来的时候，可以使用’git stash clear’来将栈清空。

	git stash          # save uncommitted changes
	## pull, edit, etc.
	git stash list     # list stashed changes in this git
	git show stash@{0} # see the last stash 
	git stash pop      # apply last stash and remove it from the list
	git stash --help   # for more info


##git stash命令过程：

1.使用git stash保存当前的工作现场，那么就可以切换到其他分支进行工作，或者在当前分支上完成其他紧急的工作，比如修订一个bug测试提交。

2.如果一个使用了一个git stash，切换到一个分支，且在该分支上的工作未完成也需要保存它的工作现场。再使用git stash。那么stash 队列中就有了两个工作现场。

3.可以使用git stash list。查看stash队列。

4.如果在一个分支上想要恢复某一个工作现场怎么办：先用git stash list查看stash队列。确定要恢复哪个工作现场到当前分支。然后用git stash pop stash@{num}。num 就是你要恢复的工作现场的编号。

5.如果想要清空stash队列则使用git stash clear。

6.同时注意使用git stash pop命令是恢复stash队列中的stash@{0}即最上层的那个工作现场。而且使用pop命令恢复的工作现场，其对应的stash 在队列中删除。使用git stash apply stash@{num}方法除了不在stash队列删除外其他和git stash pop 完全一样。
