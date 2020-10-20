
<form method="post">
<div style="text-align:center;">
You are currently operating a non-premuim version of computer based test (CBT) or have exhausted your test limit.<br />
<button class="btn btn-danger btn-xlarge" type="submit" name="btnupgrade"> Upgrade now </button><br />
to get access to prepare and publish up to 10
CBT per month.<br />
<span class="checkbox form-inline"><label for="paid">
<input type="checkbox" name="paid" id="paid" style="cursor:pointer;" onclick="Effect.toggle('testCreationAccessPin','BLIND');" /> I have a premuim version code
</label></span>
<div id="testCreationAccessPin" style="text-align:center; display:none;">
Enter your access code : <input type="password" name="accessCode" id="accessCode" placeholder="ENTER ACCESS CODE" /><br />
<button type="button" id="submitCode" name="submitCode" class="btn btn-info" onclick="preparePremuimCBT('accessCode');"> Submit Access Code </button>
</div>

</div>
</form>
