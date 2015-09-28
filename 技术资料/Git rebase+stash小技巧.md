#Git rebase + stash小技巧


天打开计算机，第一件事情就是将项目程序代码更新的最新，以便整合同事新开发的功能，免的跟自己写的功能冲突，所以最常用用的就是 git pull –rebase origin master，此命令使用 rebase 来取代 merge 程序代码，也可以避免在 log 清单内出现 merge branch master into master 等字样，但是如果在开发一半进度时，想同时将同事的程序代码先 merge 进来，会发现无法 merge，git 会请你先将 local 修改过的档案 commit，才可以让您更新，所以这时候我们可以用 git stash 方式来解决

##如果你在 master 分支上，并且想 pull 最新的 commit，可以透过底下指令步骤

	1.$ git stash --include-untracked

	2.$ git pull --rebase origin master

	3.$ git stash pop

	4.# fix conflict (merge)

**此方式一样最后需要解决冲突，解决完成，可以将 stash 清空，透过再次执行 git stash pop，或 git stash drop 就可以了，但是这样有点麻烦**

##可以不要使用 git stash 也达成这效果嘛？底下是更好的方式


	1.$ git add .

	2.$ git commit -m 'push to stash'

	3.$ git pull --rebase origin master

	4.# fix conflict (rebase)

	5.$ git reset HEAD~1

基本上原理很简单，我们先将 local 档案 commit 到 local，接着一样执行 pull –rebase 将远程 commit 拉下来，接着执行 git reset HEAD~1 就是删除最后一个 commit 但是保留最后 commit 修改的内容。
